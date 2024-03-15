<?php

namespace App\Repositories\User;

use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * $modal variable
     *
     * @var User
     */
    protected User $model;

    /**
     * Construct function
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Get function
     *
     * @param integer $id
     * @return User
     */
    public function get(int $id): User
    {
        return $this->model->find($id);
    }

    /**
     * Create function
     *
     * @param UserRequest $request
     * @return User|Exception
     */
    public function create(UserRequest $request): User|Exception
    {
        try {
            return $this->model->create(
                [
                    'fullname' => $request?->fullname,
                    'document' => $request?->document,
                    'email' => $request?->email,
                    'password' => $request?->password,
                    'user_type' => $request?->user_type
                ]
            );
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Update function
     *
     * @param integer $id
     * @param UserRequest $request
     * @return User
     */
    public function update(int $id, UpdateUserRequest $request): User
    {
        $get = $this->model->find($id);

        $get->password = $request?->password ?? $get->password;
        $get->fullname = $request?->fullname;
        $get->save();

        return $get;
    }

    /**
     * Delete function
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Get all function
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }
}
