<?php

namespace App\Events;

use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Foundation\Events\Dispatchable;

class UpdateUserEvent
{
    use Dispatchable;

    public UpdateUserRequest $user;
    public int $id;

    /**
     * Create a new event instance.
     */
    public function __construct($data)
    {
        $this->user = $data['user'];
        $this->id = $data['id'];
    }
}
