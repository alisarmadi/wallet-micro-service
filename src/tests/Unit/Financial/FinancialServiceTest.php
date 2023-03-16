<?php

namespace Tests\Unit\Financial;

use App\Models\Wallet;
use App\Repositories\MySql\TransactionRepository;
use App\Repositories\MySql\WalletRepository;
use App\Services\FinancialService;

use Tests\TestCase;

class FinancialServiceTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function walletHappyTest()
    {
        $walletRepository = \Mockery::mock(WalletRepository::class);
        $walletRepository->shouldReceive('getUserWallet')
            ->with($userId = 1)->andReturn(new Wallet(['balance' => 100]));
        $walletRepository->shouldReceive('getUserWallet')
            ->with($userId = 2)->andReturn(new Wallet(['balance' => 200]));

        $transactionRepository = \Mockery::mock(TransactionRepository::class);

        /** @var FinancialService $financialService */
        $financialService = app()->make(FinancialService::class,
            ['walletRepository' => $walletRepository, 'transactionRepository' => $transactionRepository]);

        $response = $financialService->getUserBalance(1);
        $this->assertEquals(100, $response, 'Error getting user balance');

        $response = $financialService->getUserBalance(2);
        $this->assertEquals(200, $response, 'Error getting user balance');
    }
}


