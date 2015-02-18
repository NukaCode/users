<?php namespace NukaCode\Users\Models\Relationships;

use User_Permission_Role, User_Preference;

trait User {

    public function roles()
    {
        return $this->belongsToMany('NukaCode\Users\Models\User\Permission\Role', 'role_users', 'user_id', 'role_id');
    }

    public function preferences()
    {
        return $this->belongsToMany('NukaCode\Users\Models\User\Preference', 'preferences_users', 'user_id', 'preference_id')
            ->withPivot('value')
            ->orderBy('id', 'asc');
    }
}