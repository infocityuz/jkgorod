<?php

namespace App\Console;

use App\Console\Commands\DeleteParsingCommand;
use App\Console\Commands\DeleteMonthlyCommand;
use App\Console\Commands\WebSocketServer;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    //        Commands\DemoCron::class,

    protected $commands = [
        DeleteParsingCommand::class,
        DeleteMonthlyCommand::class,
        WebSocketServer::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

//        $schedule->command('parsing:flats')
//            ->everyMinute();
//         $schedule->command('parsing:flats')->dailyAt('01:00')->withoutOverlapping();
//         $schedule->command('parsing:exchange')->dailyAt('02:00')->withoutOverlapping();
//         $schedule->command('parsing:rent')->dailyAt('03:00')->withoutOverlapping();
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('delete:parsing')->dailyAt('01:00')->withoutOverlapping();
         $schedule->command('monthly:delete')->dailyAt('02:00')->withoutOverlapping();
        //  $schedule->command('websocket:start')->everyMinute();
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
