<?php

namespace App\Console;

use App\Http\Controllers\backend\AdminNotificationController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */


  protected function schedule(Schedule $schedule)
    {
        // Weekly report (last 7 days)
        $schedule->call(function () {
            app(AdminNotificationController::class)
                ->sendPeriodicReport('7_days');
        })->weekly();

        // Monthly report (28 days)
        $schedule->call(function () {
            app(AdminNotificationController::class)
                ->sendPeriodicReport('28_days');
        })->monthly();

        // Yearly report
        $schedule->call(function () {
            app(AdminNotificationController::class)
                ->sendPeriodicReport('year');
        })->yearly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
