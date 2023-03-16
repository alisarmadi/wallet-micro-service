<?php

namespace App\Repositories\MySql;

use App\Models\Wallet;
use App\Repositories\Contract\WalletRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WalletRepository extends BaseRepository implements WalletRepositoryInterface
{
    /**
     * BaseRepository constructor.
     * @param Wallet $model
     */
    public function __construct(Wallet $model)
    {
        $this->model = new $model();
    }

    /**
     * @param int $userId
     * @return Wallet|null
     */
    public function getUserWallet(int $userId): ?Wallet
    {
        return $this->model->newQuery()->where('user_id', $userId)->first();
    }

    public function addAmount(int $userId, int $amount): Wallet
    {
        $wallet = $this->model->newQuery()->updateOrCreate(['user_id' => $userId], ['balance' => DB::raw("balance +  $amount")]);
        return $wallet->refresh();
    }
}
