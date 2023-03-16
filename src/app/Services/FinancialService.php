<?php

namespace App\Services;

use App\Repositories\Contract\TransactionRepositoryInterface;
use App\Repositories\Contract\WalletRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FinancialService
{
    public function __construct(
        protected WalletRepositoryInterface $walletRepository,
        protected TransactionRepositoryInterface $transactionRepository
    )
    {
        //
    }

    public function getUserBalance(int $userId): int
    {
        return $this->walletRepository->getUserWallet($userId)?->balance ?? 0;
    }

    public function addAmountForUser(int $userId, int $amount)
    {
        DB::beginTransaction();
        try {
            $wallet = $this->walletRepository->addAmount($userId, $amount);
            $transaction = $this->transactionRepository->create([
                'user_id' => $userId,
                'amount' => $amount,
                'remaining_amount' => $wallet->balance
                ]
            );
            DB::commit();
            return $transaction->id;
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(Response::HTTP_BAD_REQUEST, $exception->getMessage());
        }
    }

    public function getTotalTransactionsAmount($fromTime, $toTime, int $userId = null): int
    {
        return $this->transactionRepository->getTotalTransactionsAmount($fromTime, $toTime, $userId);
    }
}
