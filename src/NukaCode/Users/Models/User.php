<?php namespace NukaCode\Users\Models;

use Auth, Session, Str;
use Illuminate\Auth\UserInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use NukaCode\Users\Models\Relationships\User as UserRelationshipsTrait;
use NukaCode\Users\Models\User\Preference;
use NukaCode\Users\Models\User\Preference\User as UserPreferenceUser;
use NukaCode\Users\Models\User\Preference\User as PreferenceUser;

abstract class User extends \BaseModel {
    /********************************************************************
     * Traits
     *******************************************************************/
    use UserRelationshipsTrait;

    /********************************************************************
     * Declarations
     *******************************************************************/
    protected        $presenter = 'NukaCode\Users\Presenters\UserPresenter';

    protected static $observer  = 'NukaCode\Users\Models\Observers\UserObserver';

    /**
     * Tell eloquent to set deleted_at as carbon
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'lastActive'];

    /**
     * Define the SQL table for this model
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Set the primary key since this table does not use id
     *
     * @var string
     */
    protected $primaryKey = 'uniqueId';

    /**
     * Tell eloquent to not attempt auto incrementing the ID column
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden   = ['password', 'remember_token'];

    protected $fillable = ['username', 'email', 'firstName', 'lastName', 'displayName', 'location', 'url'];

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /********************************************************************
     * Scopes
     *******************************************************************/

    /**
     * Order by name ascending scope
     *
     * @param Builder $query The current query to append to
     *
     * @return Builder
     */
    public function scopeOrderByNameAsc($query)
    {
        return $query->orderBy('username', 'asc');
    }

    /**
     * Visible user scope
     *
     * @param Builder $query The current query to append to
     *
     * @return Builder
     */
    public function scopeVisible($query)
    {
        return $query->where('hiddenFlag', 0);
    }

    /********************************************************************
     * Setter methods
     *******************************************************************/

    /**
     * Make sure to hash the user's password on save
     *
     * @param string $value The value of the attribute (Auto Set)
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Actions of the user through the Role Relationship
     *
     * @return Action[]
     */
    public function getActionsAttribute()
    {
        return $this->roles->actions;
    }

    /********************************************************************
     * Extra Methods
     ******************************************************************/

    /**
     * Update this user's last active time.  Used for determining if they are online
     */
    public function updateLastActive()
    {
        $this->lastActive = date('Y-m-d H:i:s');
        $this->save();
    }

    public function setRoles($roleIds)
    {
        $this->roles()->detach();

        if (count($roleIds) > 0) {
            $this->roles()->attach($roleIds);
        }

        $this->save();
    }

    /********************************************************************
     * Passwords
     ******************************************************************
     *
     * Make sure the provided password matches the existing password
     *
     * @param $input
     *
     * @throws \Exception
     * @return bool
     */
    public function verifyPassword($input)
    {
        // Verify all the needed data exists and is correct
        if (! Hash::check($input['password'], $this->password)) {
            throw new \Exception('Please enter your current password');
        }

        return true;
    }

    /********************************************************************
     * Preferences
     ******************************************************************/
    public function getVisiblePreferences()
    {
        return Preference::where('hiddenFlag', 0)->orderByNameAsc()->get();
    }

    public function updatePreferenceByKeyName($preferenceKeyName, $preferenceValue)
    {
        $preference = $this->getPreferenceByKeyName($preferenceKeyName);

        $this->setPreferenceValue($preference->id, $preferenceValue);
    }

    public function getPreferenceValueByKeyName($preferenceKeyName)
    {
        $preference = Preference::where('keyName', $preferenceKeyName)->first();

        if ($preference != null) {
            $userPreference = UserPreferenceUser::where('preference_id', $preference->id)->where('user_id', $this->id)->first();

            if ($userPreference == null) {
                return $preference->default;
            }

            return $userPreference->value;
        }
    }

    public function getPreferenceByKeyName($preferenceKeyName)
    {
        $preference = Preference::where('keyName', $preferenceKeyName)->first();

        if ($preference != null) {
            $userPreference = PreferenceUser::where('preference_id', $preference->id)->where('user_id', $this->id)->first();

            if ($userPreference == null) {
                $userPreference                = new PreferenceUser();
                $userPreference->user_id       = $this->id;
                $userPreference->preference_id = $preference->id;
                $userPreference->value         = $preference->default;
                $userPreference->save();
            }

            return $userPreference;
        }

        return null;
    }

    public function getPreferenceById($preferenceId)
    {
        return UserPreferenceUser::find($preferenceId);
    }

    public function getPreferenceValue($keyName)
    {
        $preference = $this->getPreferenceByKeyName($keyName);

        return $preference->value;
    }

    public function getPreferenceOptionsArray($id)
    {
        $preference = $this->getPreferenceById($id);

        $preferenceOptions = explode('|', $preference->preference->value);
        $preferenceArray   = [];

        foreach ($preferenceOptions as $preferenceOption) {
            $preferenceArray[$preferenceOption] = ucwords($preferenceOption);
        }

        return $preferenceArray;
    }

    public function setPreferenceValue($id, $value)
    {
        $preference = $this->getPreferenceById($id);

        if ($value != $preference->value) {
            $preference->value = $value;

            if (! $preference->save()) {
                throw new \Exception($preference->getErrors());
            }
        }
    }

    public function resetPreferenceToDefault($id)
    {
        $preference = $this->getPreferenceById($id);

        $preference->value = $preference->preference->default;
        $preference->save();

        return $this;
    }

    /********************************************************************
     * Permissions
     ******************************************************************/
    /**
     * Check if a user has a permission
     *
     * @param mixed   $actions  The key name(s) of the action you are checking.
     * @param boolean $matchAll Whether to match just one action or all actions.
     *
     * @return bool
     */
    public function checkPermission($actions, $matchAll = false)
    {
        if ($this->roles->contains(getRoleId('developer'))) {
            return true;
        }

        if (! is_array($actions)) {
            $actions = [$actions];
        }

        $matchedActions = 0;

        if ($this->actions && $this->actions->count() > 0) {
            $userActions = $this->actions->keyName->toArray();

            foreach ($actions as $action) {
                if (in_array($action, $userActions)) {
                    if (! $matchAll) {
                        return true;
                    }

                    $matchedActions++;
                }
            }

            if ($matchedActions) {
                if (count($actions) == $matchedActions) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Is the User a Role
     *
     * @param  array|string $roles A single role or an array of roles
     *
     * @return boolean
     */
    public function is($roles)
    {
        if ($this->roles->count() > 0) {
            // If any role is not in the user's roles, fail
            return in_array($roles, $this->roles->keyName->toArray());
        }

        return false;
    }

    /**
     * Is the User a Role (any true)
     *
     * @param  array|string $roles A single role or an array of roles
     *
     * @return boolean
     */
    public function isOr($roles)
    {
        if (Auth::check()) {
            // If any role is in the user's roles, pass
            return (bool)array_intersect((array)$roles, (array)Session::get('roles'));
        }

        return false;
    }

    /**
     * Get the first role for this user in a particular role group
     *
     * @param  string $group The group name of the role
     *
     * @return string
     */
    public function getFirstRole($group)
    {
        $roleIds = Role::where('group', $group)->get()->id;

        return User_Permission_Role_User::where('user_id', $this->id)->whereIn('role_id', $roleIds)->first();
    }

    /**
     * Get the full object for the user's highest role in a particular role group
     *
     * @param  string $group The group name of the role
     *
     * @return Role
     */
    public function getHighestRoleObject($group)
    {
        // Get all user/role xrefs for this user
        $roles = $this->roles;

        // If the user does not have the developer role
        if (! $roles->contains(getRoleId('developer'))) {

            $roleIds = User_Permission_Role::where('group', $group)->get()->id->toArray();
            // Make sure they have at least one role
            if (count($roleIds) > 0) {

                // Look for any role that matches the group that this user has and get the highest value
                $role = User_Permission_Role_User::whereIn('role_id', $roleIds)->where('user_id', $this->id)->first();

                // If it exists, return it
                if ($role != null) {
                    return $role->role;
                }
            }
        } else {
            // For a developer, return the highest role in the requested group
            return User_Permission_Role::where('group', $group)->orderBy('priority', 'desc')->first();
        }

        // Otherwise, they are a guest
        return User_Permission_Role::find(getRoleId('guest'));
    }

    /**
     * Get the user's highest role in a particular role group
     *
     * @param  string $group The group name of the role
     *
     * @return string
     */
    public function getHighestRole($group)
    {
        return $this->getHighestRoleObject($group)->name;
    }

    /**
     * Get roles that are higher than the user's in the specified group
     *
     * @param  string $group The group name of the role
     *
     * @return User_Permission_Role[]
     */
    public function getHigherRoles($group)
    {
        $currentRole = $this->getHighestRoleObject($group);

        if ($currentRole != null) {
            $higherRoles = User_Permission_Role::where('group', $group)->where('priority', '>', $currentRole->priority)->orderBy('priority', 'asc')->get();

            return $higherRoles;
        } else {
            return User_Permission_Role::where('group', $group)->orderBy('priority', 'asc')->get();
        }
    }

    /**
     * Update the user's role within a group
     *
     * @param  string $group  The group name of the role
     * @param  int    $roleId The id of the new role
     *
     * @return void
     */
    public function updateGroupRole($group, $roleId)
    {
        // Delete any roles the user has for this group
        $roleIdsForGroup = User_Permission_Role::where('group', $group)->get()->id->toArray();
        $existingRoles   = User_Permission_Role_User::where('user_id', $this->id)->whereIn('role_id', $roleIdsForGroup)->get();

        $existingRoles->delete();

        // Add the new role
        $this->addRole($roleId);
    }

    /**
     * Add a new role for the user
     *
     * @param  int $roleId The id of the new role
     *
     * @return void
     */
    public function addRole($roleId)
    {
        // Add the new role
        $this->roles()->attach($roleId);
    }
}
