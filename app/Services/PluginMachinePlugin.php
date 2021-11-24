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
    public array $buildIncludes;
    public string $slug;
	public function __construct(
        int $pluginId,
        int $buildId,
        array $buildIncludes = [],
        string $slug

    ) {
		$this->pluginId = $pluginId;
		$this->buildId = $buildId;
        $this->buildIncludes = $buildIncludes;
        $this->slug = $slug;
	}


	public function buildId() {
		return $this->buildId;
	}

	public function id(){
		return $this->pluginId;
	}


}
