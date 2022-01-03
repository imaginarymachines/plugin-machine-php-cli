<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use League\Flysystem\Filesystem;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;
use App\Helpers;
use App\Services\PluginMachine;
use Illuminate\Support\Facades\Storage;

class ZipPlugin extends Command
{
	protected $signature = 'plugin:zip';

	protected $description = 'Zip current plugin';

	public function handle(PluginMachine $machine)
	{
		$zipPath = Helpers::writePath(
			sprintf('%s.zip', $machine->plugin->slug)
		);
		$zipPath = app_path() . Helpers::writePath() . $machine->plugin->slug . '.zip';
		$zip = new \ZipArchive();
		$zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);


		foreach ($machine->plugin->buildIncludes as $path) {
			$path = Helpers::writePath($path);
			if (is_dir(Storage::path(substr($path, 1)))) {
				$files = Storage::allFiles($path);
				if (empty($files)) {
					continue;
				}

				foreach ($files as $file) {
                    if( Storage::exists($file) ){
                        $zip->addFromString(
                            str_replace(
                                substr(Helpers::writePath(), 1),
                                '',
                                $file
                            ),
                            Storage::get($file)
                        );
                    }

				}
				continue;
			}
			if (! Storage::exists($path)) {
				$this->info(sprintf(
					'Expected file at path "%s" does not exist. Skipping.',
					$path
				));
				continue;
			}

			$zip->addFromString(
				str_replace(Helpers::writePath(), '', $path),
				Storage::get($path)
			);
			$this->info(sprintf('Added file at path "%s"', $path));
		}
        $x =         $zip->close();
		$this->info(sprintf('Zip created at "%s"', $zipPath));
		echo self::SUCCESS;
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
