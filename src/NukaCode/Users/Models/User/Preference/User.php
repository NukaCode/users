<?php

namespace NukaCode\Users\Models\User\Preference;

use App\Models\BaseModel;

class User extends BaseModel
{
    protected $table = 'preferences_users';

    protected static $observer = 'NukaCode\Users\Models\Observers\User\Preference\UserObserver';

    public function validateValue()
    {
        return (preg_match('/' . $this->preference->value . '/', $this->value) == 1 ? true : false);
    }

    public function user()
    {
        return $this->belongsTo('NukaCode\Users\Models\User', 'user_id');
    }

    public function preference()
    {
        return $this->belongsTo('NukaCode\Users\Models\User\Preference', 'preference_id');
    }
}
