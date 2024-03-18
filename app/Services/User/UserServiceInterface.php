<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    /**
     * Get all user function
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Get user function
     *
     * @param integer $id
     * @return User
     */
    public function get(int $id): User;

    /**
     * Get all notifications function
     *
     * @param integer $id
     * @return Collection
     */
    public function notifications(int $id): Collection;
}
