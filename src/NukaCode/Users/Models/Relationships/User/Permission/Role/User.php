<?php namespace NukaCode\Users\Models\Relationships\User\Permission\Role;

trait User {

    abstract public function belongsTo($related, $foreignKey = null, $otherKey = null, $relation = null);

    public function user()
    {
        return $this->belongsTo('NukaCode\Users\Models\User', 'user_id');
    }

    public function role()
    {
        return $this->belongsTo('NukaCode\Users\Models\User\Permission\Role', 'role_id');
    }
}