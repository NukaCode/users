<?php

namespace NukaCode\Users\Traits;

use Laravel\Socialite\AbstractUser;
use NukaCode\Users\Models\User\Social;

trait HasSocials
{
    public function addSocial(AbstractUser $socialUser, $provider)
    {
        $this->socials()->create([
            'provider'  => $provider,
            'social_id' => $socialUser->getId(),
            'avatar'    => $socialUser->getAvatar(),
        ]);
    }

    public function hasProvider($provider)
    {
        return $this->socials()->where('provider', $provider)->count() > 0;
    }

    public function socials()
    {
        return $this->hasMany(Social::class, 'user_id');
    }
}
