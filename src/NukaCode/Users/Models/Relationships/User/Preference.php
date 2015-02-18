<?php namespace NukaCode\Users\Models\Relationships\User;

trait Preference {

    abstract public function belongsToMany($related, $table = null, $foreignKey = null, $otherKey = null, $relation = null);

    public function users()
    {
        return $this->belongsToMany('NukaCode\Users\Models\User', 'preference_users', 'user_id', 'preference_id');
    }
}