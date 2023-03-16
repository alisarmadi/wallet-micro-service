<?php

namespace App\Jobs;

use App\Services\FinancialService;
use Illuminate\Support\Facades\Log;

class TotalAmountOfTransactionsJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private $fromTime, private $toTime)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /** @var FinancialService $financialService */
        $financialService = app()->make(FinancialService::class);

        $totalAmount = $financialService->getTotalTransactionsAmount($this->fromTime, $this->toTime);

        Log::info('The total amount of transactions in the last 24 hours: ' . $totalAmount);
    }
}
