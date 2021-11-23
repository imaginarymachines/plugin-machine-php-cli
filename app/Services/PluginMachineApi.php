<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
class PluginMachineApi {

	protected $apiToken;
	protected $apiUrl;
	public function __construct(string $apiUrl,string $apiToken ){
		$this->apiToken = $apiToken;
		$this->apiUrl = $apiUrl;
	}

	public function requestUrl(string $enpoint ): string{
		return sprintf( '%s/api/v1/%s', $this->apiUrl, $enpoint );
	}

	public function getPlugins(){
		$r = $this->getClientWithToken()
			->get(
				$this->requestUrl('plugins')
		);
		return collect($r->json()['data'])->map(function($plugin){
			return Arr::only(
				$plugin,
				['id','current_version']
			);
		});
	}



	public function getBuildCode($pluginId, $buildId){
		///plugins
		$r = $this->getClientWithToken()
			->post( $this->requestUrl( "plugins/{$pluginId}/builds/{$buildId}/code" ) );
		return $r->body();
	}

	public function getFeatureCode($pluginId, $buildId, $featureId, $file){
		$url = $this->requestUrl(
			"plugins/{$pluginId}/builds/{$buildId}/features/{$featureId}/code?file=" . urlencode($file)
		);
		///plugins
		$r = $this->getClientWithToken()
			->get( $url );
		dd($r->body());
	}

	public function addFeature(string $featureType, $pluginId, $buildId, array $data){
		$data['featureType'] = $featureType;
		$url = $this->requestUrl( "plugins/{$pluginId}/builds/{$buildId}/features" );
		///plugins
		$r = $this->getClientWithToken()
			->post( $url,$data );
		if(201 === $r->status() ){
			return [
				'files' => $r->json('files'),
				'id' => $r->json('setting.id'),
			];
		}else{
			throw new \Exception( $r->json('message') );
		}

	}

	public function addPlugin(array $data){
		///plugins
		$r = $this->getClientWithToken()
			->post( $this->requestUrl( "/plugins/"),$data );
		dd($r);
	}

	protected function getClientWithToken():PendingRequest{
		return Http::withToken($this->apiToken);
	}
}
