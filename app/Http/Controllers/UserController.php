<?php

namespace App\Http\Controllers;

use App\Events\CreateUserEvent;
use App\Events\UpdateUserEvent;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\AllUserResource;
use App\Http\Resources\User\CreatedUserResource;
use App\Http\Resources\User\GetUserResource;
use App\Http\Resources\User\UpdatedUserResource;
use App\Services\User\UserServiceInterface;

class UserController extends Controller
{
    /**
     * Construct function
     *
     * @param UserServiceInterface $service
     */
    public function __construct(
        protected UserServiceInterface $service
    ) {}

    /**
     * Create user function
     *
     * @param UserRequest $request
     * @return void
     */
    public function create(UserRequest $request)
    {
        CreateUserEvent::dispatch($request);

        return new CreatedUserResource($request);        
    }

    /**
     * Edit user function
     *
     * @param UpdateUserRequest $request
     * @param integer $id
     * @return void
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        UpdateUserEvent::dispatch( 
            [
                'user' => $request,
                'id' => $id
            ]
        );
        
        return new UpdatedUserResource($this->service->get($id));
    }

    /**
     * Get all users function
     *
     * @return void
     */
    public function all()
    {
        return new AllUserResource($this->service->all());
    }

    /**
     * Get user function
     *
     * @param integer $id
     * @return void
     */
    public function get(int $id)
    {
        return new GetUserResource($this->service->get($id));
    }
}
