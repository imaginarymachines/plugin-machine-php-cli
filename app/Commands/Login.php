<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Helpers;
use App\Config;
class Login extends Command
{

    protected $signature = 'login';


    protected $description = 'Login Command';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		dd(Config::get('token'));
        Config::set('token', 'carl');
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
