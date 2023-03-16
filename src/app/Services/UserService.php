<?php

namespace App\Services;

use App\Repositories\Contract\UserRepositoryInterface;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    )
    {
        //
    }

    public function isUserExist(int $userId)
    {
        return (bool)$this->userRepository->find($userId);
    }
}
