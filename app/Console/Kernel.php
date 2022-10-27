<?php

namespace App\Console;

use App\Jobs\ketikaWaktuUjianHabis;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        /**
         * Dokumentasi scheduler
         * https://laravel.com/docs/9.x/scheduling#schedule-frequency-options
         */
        $schedule->job(new ketikaWaktuUjianHabis())
                    ->weekdays()
                    ->everyFiveMinutes()
                    ->timezone('Asia/Jakarta')
                    ->between('6:00', '21:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
