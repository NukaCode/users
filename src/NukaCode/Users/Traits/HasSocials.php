<?php

namespace NukaCode\Users\Traits;

use Laravel\Socialite\AbstractUser;
use NukaCode\Users\Models\User\Social;

/**
 * Class HasSocials
 *
 * @package NukaCode\Users\Traits
 *
 * @method getProvider($provider)
 */
trait HasSocials
{
    public function addSocial(AbstractUser $socialUser, $provider)
    {
        $refreshToken = isset($socialUser->refresh_token) && $socialUser->refresh_token
            ? $socialUser->refresh_token
            : null;

        $this->socials()->create([
            'provider'      => $provider,
            'social_id'     => $socialUser->getId(),
            'avatar'        => $socialUser->getAvatar(),
            'token'         => $socialUser->token,
            'refresh_token' => $refreshToken,
        ]);
    }

    public function scopeGetProvider($query, $provider)
    {
        return $query->socials()->where('provider', $provider)->first();
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
