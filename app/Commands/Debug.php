<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Helpers;
use App\Services\Features;

class Debug extends Command
{

    protected $signature = 'debug';


    protected $description = 'Print debub info';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Features $features)
    {
        $this->info('App path: ' . app_path());
        $this->info('Write path: ' . Helpers::writePath());
        $this->info('Rules path: ' . $features->getRulesDataPath());
        $this->info('Rules exist: ' . $features->rulesDataExists());
        $this->info('Features path: ' . $features->featuresDataExists());
        $this->info('Features exist: ' . $features->featuresDataExists());
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
