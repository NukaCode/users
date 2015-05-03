<?php namespace NukaCode\Users\Models\Relationships\User\Permission;

trait Role {

    public function actions()
    {
        return $this->belongsToMany('NukaCode\Users\Models\User\Permission\Action', 'action_roles', 'role_id', 'action_id');
    }

    public function users()
    {
        return $this->belongsToMany('NukaCode\Users\Models\User', 'role_users', 'role_id', 'user_id');
    }
}