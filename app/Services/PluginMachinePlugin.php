<?php

namespace App\Services;


use Illuminate\Support\Arr;
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

    /**
     * Create from array
     *
     * @return PluginMachinePlugin
     */
    public static function fromArray(array $data) {
        $plugin = new static(
            $data['pluginId'],
            $data['buildId'],
            Arr::get($data,'buildIncludes',[]),
            Arr::get($data,'slug',''),
        );
        return $plugin;
    }

	public function buildId() {
		return $this->buildId;
	}

	public function id(){
		return $this->pluginId;
	}


}
