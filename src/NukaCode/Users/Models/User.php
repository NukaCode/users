<?php

namespace NukaCode\Users\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use NukaCode\Users\Traits\HasRoles;

abstract class User extends BaseModel
{
    use HasRoles, SoftDeletes;

    /**
     * Define the SQL table for this model
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'username',
        'email',
        'firstName',
        'lastName',
        'displayName',
        'location',
        'url',
    ];

    /**
     * Tell eloquent to set deleted_at as a carbon date.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * Determines if the users has global rights.
     *
     * @return mixed
     */
    public function isSuperUser()
    {
        if (config('nukacode-user.allow_super_user') == true
            && $this->super_flag == 1
        ) {
            return true;
        }

        return false;
    }

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
     * Make sure to hash the user's password on save
     *
     * @param string $value The value of the attribute (Auto Set)
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
