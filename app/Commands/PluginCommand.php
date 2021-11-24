<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Services\PluginMachine;
use App\Services\PluginMachinePlugin;
use App\Services\PluginMachineApi;

use App\Helpers;

/**
 * Abstract class for commands that use pluginMachine.json to extend
 */
abstract class PluginCommand extends Command {
    /**
     * @var PluginMachine
     */
    protected  $pluginMachine;
    public function __construct()
    {
        $this->pluginMachine = new PluginMachine(
            app()->make(PluginMachineApi::class),
            PluginMachinePlugin::fromArray(
                Helpers::pluginConfig()
            )
        );
        parent::__construct();
    }

    public function hasConfig(){
        return !empty(Helpers::pluginConfig());
    }
}
