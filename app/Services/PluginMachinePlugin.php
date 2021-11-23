<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
class PluginMachinePlugin {

	public $writeDir;
	public $pluginId;
	public $buildId;

	public function __construct( int $pluginId, int $buildId, string $writeDir) {
		$this->pluginId = $pluginId;
		$this->buildId = $buildId;
		$this->writeDir = $writeDir;
	}


	public function buildId() {
		return $this->buildId;
	}

	public function id(){
		return $this->pluginId;
	}

}
