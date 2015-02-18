<?php namespace NukaCode\Users\Models\Relationships\User;

trait Preference {

    public function users()
    {
        return $this->belongsToMany('NukaCode\Users\Models\User', 'preference_users', 'user_id', 'preference_id');
    }
} 