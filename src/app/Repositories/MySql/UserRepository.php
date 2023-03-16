<?php

namespace App\Repositories\MySql;

use App\Models\User;
use App\Repositories\Contract\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * BaseRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = new $model();
    }

    /**
     * @param int $userId
     * @return User|null
     */
    public function find(int $userId): ?User
    {
        return $this->model->newQuery()->find($userId);
    }

    public function findByEmail(string $email)
    {
        return $this->model->newQuery()->where('email', $email)->first();
    }
}
