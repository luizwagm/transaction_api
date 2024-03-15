<?php

namespace App\Http\Controllers;

use App\Events\CreateUserEvent;
use App\Events\UpdateUserEvent;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Services\User\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service
    ) {}

    public function create(UserRequest $request)
    {
        CreateUserEvent::dispatch($request);
        
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        UpdateUserEvent::dispatch( 
            [
                'user' => $request,
                'id' => $id
            ]
        );
        
    }

    public function delete()
    {
        die('olha ai');
    }

    public function all()
    {
        return response()->json(
            [$this->service->all()],
            200
        );
    }

    public function get(int $id)
    {
        return response()->json(
            [$this->service->get($id)],
            200
        );
    }
}
