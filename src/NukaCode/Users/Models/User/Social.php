<?php

namespace NukaCode\Users\Models\User;

use App\Models\BaseModel;

class Social extends BaseModel
{
    protected $table = 'user_socials';

    protected $fillable = [
        'user_id',
        'provider',
        'social_id',
        'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'user_id');
    }
}
