<?php

namespace App\Console;

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

     protected $commands = [
        Commands\TestTask::class,
        Commands\TestTask2::class,
        Commands\TestTask3::class,
        Commands\TestTask4::class
     ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('test:task')->everyminute();
        $schedule->command('test:task2')->everyminute();
        $schedule->command('test:task3')->everyminute();
        $schedule->command('test:task4')->everyminute();
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
