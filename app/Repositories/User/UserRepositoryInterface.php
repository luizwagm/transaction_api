<?php

namespace App\Repositories\User;

use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * Get function
     *
     * @param integer $id
     * @return User
     */
    public function get(int $id): User;

    /**
     * Create function
     *
     * @param UserRequest $request
     * @return User|Exception
     */
    public function create(UserRequest $request): User|Exception;

    /**
     * Update function
     *
     * @param integer $id
     * @param UserRequest $request
     * @return User
     */
    public function update(int $id, UpdateUserRequest $request): User;

    /**
     * Delete function
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool;

    /**
     * Get all function
     *
     * @return Collection
     */
    public function all(): Collection;
}
