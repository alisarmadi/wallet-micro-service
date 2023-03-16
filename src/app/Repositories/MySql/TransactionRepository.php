<?php

namespace App\Repositories\MySql;

use App\Models\Transaction;
use App\Repositories\Contract\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    /**
     * BaseRepository constructor.
     * @param Transaction $model
     */
    public function __construct(Transaction $model)
    {
        $this->model = new $model();
    }

    public function getTotalTransactionsAmount($fromTime, $toTime, int $userId = null): int
    {
        $transactions = $this->model->newQuery();
        if ( $userId ) {
            $transactions = $transactions->where('user_id', $userId);
        }
        $transactions = $transactions
            ->where('created_at', '>=', $fromTime)
            ->where('created_at', '<=', $toTime)
            ->select(DB::raw('SUM(amount) as total_amount'))
            ->first();

        return (int)($transactions->total_amount ?? 0);
    }
}
