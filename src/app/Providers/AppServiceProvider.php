<?php

namespace App\Providers;

use App\Repositories\Contract\TransactionRepositoryInterface;
use App\Repositories\Contract\UserRepositoryInterface;
use App\Repositories\Contract\WalletRepositoryInterface;
use App\Repositories\MySql\TransactionRepository;
use App\Repositories\MySql\UserRepository;
use App\Repositories\MySql\WalletRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(WalletRepositoryInterface::class, WalletRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
    }
}
