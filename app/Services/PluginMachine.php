<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
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

	public function getApi(): PluginMachineApi {
		return $this->api;
	}

	public function addFeature( string $feature, array $data ){
		try {
			$r = $this->api->addFeature(
				$feature,
				$this->plugin->id(),
				$this->plugin->buildId(),
				$data
			);
			$files = $r->json( 'files');
			$id = $r->json( 'id');

		if( ! $files ){
			//?
			return false;
		}
		foreach ($files as $path => $contents) {
			$writePath = sprintf('%s/$s', $this->plugin->writeDir, $path);
			Storage::put($writePath, $contents);
		}
		return true;
	}
		}catch( \Exception $e ){
						return false;

		}



	protected function getClientWithToken():PendingRequest{
		return Http::withToken($this->apiToken);
	}
}
