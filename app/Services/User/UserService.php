<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {}

    public function all()
    {
        return $this->repository->all();
    }

    public function get(int $id)
    {
        return $this->repository->get($id);
    }
    
}
