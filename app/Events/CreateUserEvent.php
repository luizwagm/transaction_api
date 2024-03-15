<?php

namespace App\Events;

use App\Http\Requests\User\UserRequest;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateUserEvent
{
    use Dispatchable;

    public UserRequest $user;
    public int $userId;

    /**
     * Create a new event instance.
     */
    public function __construct(UserRequest $request)
    {
        $this->user = $request;
    }

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }
}
