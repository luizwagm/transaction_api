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
use Illuminate\Http\JsonResponse;

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
    * @OA\Post(
     *     path="/api/user",
     *     summary="Create a new user",
     *     tags={"User"},
     *     @OA\Parameter(
     *         name="fullname",
     *         in="query",
     *         description="User's fullname",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="document",
     *         in="query",
     *         description="User's document",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="user_type",
     *         in="query",
     *         description="User type",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             enum={
     *                   "common",
     *                   "shopman",
     *             },
     *         )
     *     ),
     *     @OA\Response(response="201", description="User registered successfully", @OA\JsonContent()),
     *     @OA\Response(response="422", description="Do not create an existing user", @OA\JsonContent())
     * )
     */
    public function create(UserRequest $request): JsonResponse
    {
        CreateUserEvent::dispatch($request);

        return response()->json(new CreatedUserResource($request), 201);        
    }

    /**
    * @OA\Put(
     *     path="/api/user/{id}",
     *     summary="Update user",
     *     tags={"User"},
     *     @OA\Parameter(
     *         name="fullname",
     *         in="query",
     *         description="User's fullname",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User's id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="User updated successfully")
     * )
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
    * @OA\Get(
     *     path="/api/user",
     *     tags={"User"},
     *     summary="Get all user with wallet",
     *     @OA\Response(response="200", description="Get all user with wallet")
     * )
     */
    public function all(): AllUserResource
    {
        return new AllUserResource($this->service->all());
    }

    /**
    * @OA\Get(
     *     path="/api/user/{id}",
     *     summary="Get user with wallet",
     *     tags={"User"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User's id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Get user with wallet")
     * )
     */
    public function get(int $id): GetUserResource
    {
        return new GetUserResource($this->service->get($id));
    }

    /**
    * @OA\Get(
     *     path="/api/user/notifications/{id}",
     *     summary="Get all notifications of user",
     *     tags={"User"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User's id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Get all notifications of user")
     * )
     */
    public function notifications(int $id): GetNotificationsResource
    {
        return new GetNotificationsResource($this->service->notifications($id));
    }
}
