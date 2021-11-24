<?php

use App\Services\PluginMachine;
use App\Services\PluginMachineApi;
use App\Services\PluginMachinePlugin;
use Illuminate\Support\Facades\Storage;


test('Adds pluginMachine.json files', function(){
    Storage::fake();
    $pluginMachine = app( PluginMachine::class );

    $this->assertTrue($pluginMachine->writePluginJson(
        4
    ));

});
