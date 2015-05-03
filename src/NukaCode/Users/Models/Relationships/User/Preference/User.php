<?php namespace NukaCode\Users\Models\Relationships\User\Preference;

trait User {

    public function user()
    {
        return $this->belongsTo('NukaCode\Users\Models\User', 'user_id');
    }

    public function preference()
    {
        return $this->belongsTo('NukaCode\Users\Models\User\Preference', 'preference_id');
    }
}