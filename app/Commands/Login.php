<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Helpers;
use App\Config;
use App\Services\Features;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class Login extends Command
{

	protected $signature = 'login {token}';


	protected $description = 'Login Command';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle(Features $features)
	{
		Helpers::token($this->argument('token'));
		$this->info('Token set');
		//Sync rules locally if needed.
		if (! $features->rulesDataExists() || ! $features->featuresDataExists()) {
			Artisan::call(SyncRules::class);
			echo Artisan::output();
		}
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
