<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Version extends Command
{
	/**
	 * The signature of the command.
	 *
	 * @var string
	 */
	protected $signature = 'version';

	/**
	 * The description of the command.
	 *
	 * @var string
	 */
	protected $description = 'Shows current CLI version information.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->info(sprintf('Version is: %s', '0.3.1'));
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
