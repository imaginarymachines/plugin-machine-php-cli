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
        string $writeDir,
        array $buildIncludes = [],
        string $slug

    ) {
		$this->pluginId = $pluginId;
		$this->buildId = $buildId;
		$this->writeDir = $writeDir;
        $this->buildIncludes = $buildIncludes;
        $this->slug = $slug;
	}


	public function buildId() {
		return $this->buildId;
	}

	public function id(){
		return $this->pluginId;
	}

    public function writePath($path):string{
        return sprintf('%s/%s', $this->writeDir, $path);
    }
}
