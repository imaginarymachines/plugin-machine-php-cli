<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Version extends Command
{

	protected $signature = 'version';


	protected $description = 'Shows current CLI version information.';


	public function handle()
	{
		$this->info(sprintf('Version is: %s', '0.5.6'));
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
