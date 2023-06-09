<?php

namespace App\Console;

use App\Console\Commands\CheckKeywords;
use App\Console\Commands\CheckPhoneNumbers;
use App\Console\Commands\CheckSenderID;
use App\Console\Commands\CheckSubscription;
use App\Console\Commands\CheckUserPreferences;
use App\Console\Commands\RunCampaign;
use App\Console\Commands\UpdateDemo;
use App\Console\Commands\UpdateImartGroupDLR;
use App\Console\Commands\VisionUpInboundMessage;
use App\Console\Commands\WhatsenderInbound;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
            CheckSubscription::class,
            CheckKeywords::class,
            CheckPhoneNumbers::class,
            CheckSenderID::class,
            CheckUserPreferences::class,
            RunCampaign::class,
            UpdateDemo::class,
            WhatsenderInbound::class,
            VisionUpInboundMessage::class,
            UpdateImartGroupDLR::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  Schedule  $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('queue:work --once --tries=1')->everyMinute();
        $schedule->command('campaign:run')->everyMinute();
        $schedule->command('subscription:check')->hourly();
        //    $schedule->command('visionup:inbound')->hourly();
        $schedule->command('imartgroup:dlr')->everyThirtyMinutes();
        $schedule->command('keywords:check')->daily();
        $schedule->command('numbers:check')->daily();
        $schedule->command('senderid:check')->daily();
        $schedule->command('user:preferences')->daily();

        if (config('app.stage') == 'demo') {
            $schedule->command('demo:update')->daily();
        }
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
