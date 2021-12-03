<?php

namespace App\Commands;

use App\Services\Features;
use App\Services\PluginMachine;
use App\Services\PluginMachineApi;
use App\Services\PluginMachinePlugin;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Add extends Command
{
	/**
	 * The signature of the command.
	 *
	 * @var string
	 */
	protected $signature = 'add';

	/**
	 * The description of the command.
	 *
	 * @var string
	 */
	protected $description = 'Add feature to plugin';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle(Features $features, PluginMachine $pluginMachine)
	{

		//Choose feature type
		$featureLabel = $this->choice(
			'What do you want to add to this plugin?',
			$features->getFeatureOptions('flat.label'),
			3
		);
		//get feature and its rules from
		$feature = $features->getFeatureBy($featureLabel, 'singular');
		$rules = $features->getRules($feature->type);
		//Collect data by asking for each value
		$data = [];
		foreach ($rules as $key => $field) {
			$label = isset($field->label)&& ! empty($field->label) ? $field->label : $key;

			if (isset($field->options)) {
				$options = (array)$field->options;
				$value = $this->choice(
					$label,
					array_values($options),
					Arr::first($options)
				);
				switch ($feature->type) {
					case 'adminPage':
						$data[$key] = strtoupper($value);
						break;
					default:
						$data[$key] = strtolower($value);
						break;
				}
			} else {
				$data[$key] = $this->ask($label);
			}
		}

		try {
			//Ask machine to add feature, get back array of files added
			$r = $pluginMachine->addFeature($feature->type, $data);
			foreach ($r->files as $file) {
				$this->info('Added file: ' . $file);
			}
            if( ! empty($r->main)){
                foreach ($r->main as $mainLine) {
                    $this->warn('You must add to main plugin file');
                    $this->info($mainLine);
                }
            }
		} catch (\Throwable $th) {
			$this->error($th->getMessage());
		}
	}
}
