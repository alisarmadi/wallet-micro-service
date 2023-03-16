<?php

namespace App\Repositories\Contract;


use App\Models\User;

interface UserRepositoryInterface
{
    public function find(int $userId): ?User;

    public function findByEmail(string $email);
}
