<?php namespace NukaCode\Users\Models\Relationships\User\Permission\Action;

trait Role {

    public function action()
    {
        return $this->belongsTo('NukaCode\Users\Models\User\Permission\Action', 'action_id');
    }

    public function role()
    {
        return $this->belongsTo('NukaCode\Users\Models\User\Permission\Role', 'role_id');
    }
} 