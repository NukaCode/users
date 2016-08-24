<?php

namespace NukaCode\Users\Events;

use Illuminate\Queue\SerializesModels;
use Laravel\Socialite\AbstractUser;
use NukaCode\Users\Models\User;

class UserLoggedIn
{
    use SerializesModels;

    /**
     * @var \NukaCode\Users\Models\User
     */
    public $user;

    /**
     * @var \Laravel\Socialite\AbstractUser|null
     */
    public $socialUser;

    /**
     * Create a new event instance.
     *
     * @param \NukaCode\Users\Models\User          $user
     * @param \Laravel\Socialite\AbstractUser|null $socialUser
     */
    public function __construct(User $user, AbstractUser $socialUser = null)
    {
        $this->user       = $user;
        $this->socialUser = $socialUser;
    }
}
