<?php

namespace App\Repositories\Contract;

use Illuminate\Database\Eloquent\Model;

interface TransactionRepositoryInterface
{
    public function create(array $data): Model;
    public function getTotalTransactionsAmount(int $fromTime, int $toTime, int $userId = null): int;
}
