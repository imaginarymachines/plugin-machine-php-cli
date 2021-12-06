<?php

namespace App\Services;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;

class Features
{

	protected $features;
	protected $featuresData;
	protected $rulesData;

	const PATH_FEATURES = '/data/features.json';
	const PATH_RULES = '/data/rules.json';
	public function __construct()
	{
		$this->rulesData = (array) json_decode(
			file_get_contents(__DIR__ .self::PATH_RULES)
		);
		$this->featuresData = (array) json_decode(
			file_get_contents(__DIR__ .self::PATH_FEATURES)
		);
		$this->features = collect($this->featuresData)->map(function ($feature) {
			return $feature->feature;
		})->toArray();
	}

	public function getRules(string $feature)
	{
		return $this->rulesData[$feature];
	}
	public function getFeatureOptions($as = 'flat', bool $withPluginHooks = false) :array
	{
		$options = [];
		switch ($as) {
			case 'flat.value':
			case 'flat':
				foreach ($this->getFeatures($withPluginHooks) as $key => $value) {
					$options[] = $value->type;
				}
				break;
			case 'flat.label':
			case 'flat.label.singular':
				foreach ($this->getFeatures($withPluginHooks) as $key => $value) {
					$options[] = $value->singular;
				}
				break;
			default:
				$options = $this->getFeatures($withPluginHooks);
				break;
		}
		return $options;
	}

	public function getFeatureBy(string $search, string $by, bool $withPluginHooks = false) : \stdClass
	{

		$c = collect($this->getFeatures($withPluginHooks))
			->filter(function ($feature) use ($by, $search) {
				return $feature->$by == $search;
			});
		if ($c->count()) {
			return $c->first();
		}
			throw new \Exception();
	}


	public function getFeatures(bool $withPluginHooks = false): array
	{
		if (! $withPluginHooks) {
			return collect($this->features)->filter(function ($feature) {
				return false == $feature->isPluginHook;
			})->toArray();
		}
	}
}
