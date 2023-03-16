<?php

namespace App\Repositories\Contract;

use App\Models\Wallet;

interface WalletRepositoryInterface
{
    public function getUserWallet(int $userId): ?Wallet;
    public function addAmount(int $userId, int $amount): ?Wallet;
}
