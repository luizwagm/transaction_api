<?php

namespace App\Http\Controllers;

use App\Events\CreateUserEvent;
use App\Events\UpdateUserEvent;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\AllUserResource;
use App\Http\Resources\User\CreatedUserResource;
use App\Http\Resources\User\GetNotificationsResource;
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
     * @return CreatedUserResource
     */
    public function create(UserRequest $request): CreatedUserResource
    {
        CreateUserEvent::dispatch($request);

        return new CreatedUserResource($request);        
    }

    /**
     * Edit user function
     *
     * @param UpdateUserRequest $request
     * @param integer $id
     * @return UpdatedUserResource
     */
    public function update(UpdateUserRequest $request, int $id): UpdatedUserResource
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
     * @return AllUserResource
     */
    public function all(): AllUserResource
    {
        return new AllUserResource($this->service->all());
    }

    /**
     * Get user function
     *
     * @param integer $id
     * @return GetUserResource
     */
    public function get(int $id): GetUserResource
    {
        return new GetUserResource($this->service->get($id));
    }

    /**
     * Get all notifications function
     *
     * @param integer $id
     * @return GetNotificationsResource
     */
    public function notifications(int $id): GetNotificationsResource
    {
        return new GetNotificationsResource($this->service->notifications($id));
    }
}
