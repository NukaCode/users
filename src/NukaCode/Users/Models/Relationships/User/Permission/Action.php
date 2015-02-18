<?php namespace NukaCode\Users\Models\Relationships\User\Permission;

trait Action {

    public function roles()
    {
        return $this->belongsToMany('NukaCode\Users\Models\User\Permission\Role', 'action_roles', 'action_id', 'role_id');
    }
} 