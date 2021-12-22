<?php

namespace App\Commands;

use App\Services\Features;
use App\Services\PluginMachineApi;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\Storage;

class SyncRules extends Command
{

	protected $signature = 'sync';

	protected $description = 'Update feature and rule JSON files';


	public function handle(PluginMachineApi $api, Features $features)
	{
		$json = $this->encodeJsonPretty(
			$api->getRules()
		);
		file_put_contents($features->getRulesDataPath(), $json);

		$json = $this->encodeJsonPretty(
			$api->getFeatures()
		);
		file_put_contents($features->getFeaturesDataPath(), $json);
		$this->info('Sync complete');
	}

	protected function encodeJsonPretty(array$data):string
	{
		return json_encode($data, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
	}
}
