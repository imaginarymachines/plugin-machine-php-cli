<?php
use App\Helpers;
use App\Commands\GetPluginMachineJson;
test('Get config', function () {
    return;
    Helpers::token(env('TEST_PLUGIN_MACHINE_TOKEN'));
    $this->artisan(GetPluginMachineJson::class, ['pluginId' => '2'])
         ->assertExitCode(0);
         expect(Helpers::pluginConfig()['pluginId'])->toEqual('2');

});
