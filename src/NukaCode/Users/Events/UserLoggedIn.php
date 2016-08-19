<?php

namespace NukaCode\Users\Events;

use Illuminate\Queue\SerializesModels;
use NukaCode\Users\Models\User;

class UserLoggedIn
{
    use SerializesModels;

    /**
     * @var \NukaCode\Users\Models\User
     */
    public $user;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
