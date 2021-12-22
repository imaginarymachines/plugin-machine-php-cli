<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Helpers;

/**
 * High level API for using Plugin Machine
 */
class PluginMachine
{

	/**
	 * @var PluginMachineApi
	 */
	protected $api;
	/**
	 * @var PluginMachinePlugin
	 */
	public $plugin;

	/**
	 * Path to write files to.
	 *
	 * @var string
	 */
	public $writePath;
	public function __construct(PluginMachineApi $api, PluginMachinePlugin $plugin, string $writePath)
	{
		$this->api = $api;
		$this->plugin = $plugin;
		$this->writePath = $writePath;
	}

	/**
	 * Get the API instance
	 */
	public function getApi(): PluginMachineApi
	{
		return $this->api;
	}

	/**
	 * Add a feature to plugin
	 *
	 * Saves setting
	 * Downloads and writes each file.
	 */
	public function addFeature(string $feature, array $data)
	{

		$r = $this->api->addFeature(
			$feature,
			$this->plugin,
			$data
		);

		$files = $r['files'];
		$main = $r['main'];
		$id = $r['id'];


		if (! $files) {
			throw new \Exception("No files");
		}

		foreach ($files as $path) {
			try {
				$contents = $this->api
					->getFeatureCode(
						$id,
						$this->plugin,
						$path
					);

				Storage::put(
					$this->writePath($path),
					$contents
				);
			} catch (\Throwable $th) {
				throw $th;
			}
		}
		//If we have pluginMachine.json in response, update it.
		$pluginMachineJson = Arr::get('pluginMachineJson', $r, null);
		if (! empty($pluginMachineJson) && ! empty(json_decode($pluginMachineJson, true))) {
			Helpers::pluginConfig(json_decode($pluginMachineJson, true));
		}
		return (object)['files' => $files, 'main' => $main];
	}

	/**
	 * Get pluginMachine.json for a plugin
	 *
	 * @param int $pluginId
	 */
	public function writePluginJson(int $pluginId)
	{
		$r = $this->api->getPluginJson(
			$pluginId
		);
		if (false != $r && ! empty($r)) {
			Storage::put($this->writePath('pluginMachine.json'), $r);
			return true;
		}
		return false;
	}

	/**
	 * Get full path to write to.
	 */
	public function writePath(string $path)
	{
		return $this->writePath . '/' . $path;
	}

	/**
	 * Get PluginMachinePlugin
	 * @return PluginMachinePlugin
	 */
	public function getPlugin()
	{
		return $this->plugin;
	}
}
