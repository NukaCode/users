<?php namespace NukaCode\Users\Models\Relationships\User\Permission;

trait Action {

    abstract public function belongsToMany($related, $table = null, $foreignKey = null, $otherKey = null, $relation = null);

    public function roles()
    {
        return $this->belongsToMany('NukaCode\Users\Models\User\Permission\Role', 'action_roles', 'action_id', 'role_id');
    }
}