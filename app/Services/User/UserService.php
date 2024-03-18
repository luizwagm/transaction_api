<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserServiceInterface
{
    /**
     * Construct function
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(
        protected UserRepositoryInterface $repository,
        protected NotificationRepositoryInterface $notificationRepository
    ) {}

    /**
     * Get all user function
     *
     * @param integer $id
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->repository->all();
    }

    /**
     * Get user function
     *
     * @param integer $id
     * @return User
     */
    public function get(int $id): User
    {
        return $this->repository->get($id);
    }

    /**
     * Get all notifications function
     *
     * @param integer $id
     * @return Collection
     */
    public function notifications(int $id): Collection
    {
        return $this->notificationRepository->get($id);
    }
}
