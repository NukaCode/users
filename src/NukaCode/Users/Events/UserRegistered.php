<?php

namespace NukaCode\Users\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use NukaCode\Users\Models\User;

class UserRegistered extends Event
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
