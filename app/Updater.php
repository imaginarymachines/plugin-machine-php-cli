<?php

namespace App;

use Humbug\SelfUpdate\Updater as PharUpdater;
use Illuminate\Console\OutputStyle;

class Updater
{
	/**
	 * The base updater.
	 *
	 * @var \Humbug\SelfUpdate\Updater
	 */
	private $updater;

	/**
	 * Updater constructor.
	 *
	 * @param  \Humbug\SelfUpdate\Updater  $updater
	 */
	public function __construct(PharUpdater $updater)
	{
		$this->updater = $updater;
	}

	/**
	 * @param  \Illuminate\Console\OutputStyle  $output
	 * @return void
	 */
	public function update(OutputStyle $output): void
	{
		$result = $this->updater->update();

		if ($result) {
			$output->success(sprintf(
				'Updated from version %s to %s.',
				$this->updater->getOldVersion(),
				$this->updater->getNewVersion()
			));
			exit(0);
		} elseif (! $this->updater->getNewVersion()) {
			$output->success('There are no stable versions available.');
		} else {
			$output->success('You have the latest version installed.');
		}
	}
}
