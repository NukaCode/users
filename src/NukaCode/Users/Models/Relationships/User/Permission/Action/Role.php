<?php namespace NukaCode\Users\Models\Relationships\User\Permission\Action;

trait Role {

    abstract public function belongsTo($related, $foreignKey = null, $otherKey = null, $relation = null);

    public function action()
    {
        return $this->belongsTo('NukaCode\Users\Models\User\Permission\Action', 'action_id');
    }

    public function role()
    {
        return $this->belongsTo('NukaCode\Users\Models\User\Permission\Role', 'role_id');
    }
} 