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
     * @var array
     */
    public $request;

    /**
     * Create a new event instance.
     *
     * @param \NukaCode\Users\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->user    = $user;
        $this->request = request()->all();
    }
}
