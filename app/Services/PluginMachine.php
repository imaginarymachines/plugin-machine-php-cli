<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
/**
 * High level API for using Plugin Machine
 */
class PluginMachine {

	/**
	 * @var PluginMachineApi
	 */
	protected $api;
	/**
	 * @var PluginMachinePlugin
	 */
	protected $plugin;
	public function __construct(PluginMachineApi $api, PluginMachinePlugin $plugin){
		$this->api = $api;
		$this->plugin = $plugin;
	}

    /**
     * Get the API instance
     */
	public function getApi(): PluginMachineApi {
		return $this->api;
	}

    /**
     * Add a feature to plugin
     *
     * Saves setting
     * Downloads and writes each file.
     */
	public function addFeature( string $feature, array $data ){

        $r = $this->api->addFeature(
            $feature,
            $this->plugin,
            $data
        );

        $files = $r['files'];
        $id = $r['id'];

		if( ! $files ){
			throw new \Exception("No files");

		}

		foreach ($files as $path ) {
            try {
                $contents = $this->api
                    ->getFeatureCode(
                        $id,
                        $this->plugin,
                        $path
                    );
                Storage::put(
                    $this->plugin->writePath($path),
                    $contents
                );
            } catch (\Throwable $th) {
                throw $th;
            }

		}
		return $files;
	}

    /**
     * Get pluginMachine.json for a plugin
     *
     * @param int $pluginId
     */
    public function writePluginJson(int $pluginId){
        $r = $this->api->getPluginJson(
            $pluginId
        );
        if( false != $r && ! empty($r)){
            Storage::put($this->plugin->writePath('pluginMachine.json'),$r);
            return true;
        }
        return false;
    }


}
