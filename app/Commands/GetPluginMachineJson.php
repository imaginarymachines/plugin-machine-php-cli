<?php

namespace App\Commands;

use App\Services\PluginMachineApi;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Helpers;
class GetPluginMachineJson extends Command
{

    protected $signature = 'plugin:config {pluginId}';
    protected $description = 'Get pluginMachine.json for a plugin';


    public function handle(PluginMachineApi $api)
    {
        $pluginId = $this->argument('pluginId');
        try {
            $json = $api->getPluginJson($pluginId);
            Helpers::pluginConfig(json_decode($json,true));
            $this->info('Config saved');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }


    }


}
