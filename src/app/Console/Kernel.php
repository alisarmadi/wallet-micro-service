<?php

namespace App\Console;

use App\Console\Commands\CreateDatabase;
use App\Jobs\TotalAmountOfTransactionsJob;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected array $commands = [
        CreateDatabase::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $fromTime = Carbon::now()->subDay();
            $toTime = Carbon::now();
            dispatch( new TotalAmountOfTransactionsJob($fromTime, $toTime));
        })->everyMinute(); // ->dailyAt('01:00');
    }
}
