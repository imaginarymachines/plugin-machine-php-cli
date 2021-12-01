<?php
use App\Helpers;
use App\Commands\GetPluginMachineJson;
use Illuminate\Support\Facades\Http;

test('Get config', function () {
    Http::fake([
        '*' => Http::response(['pluginId' => '2'], 200, []),
    ]);
    Helpers::token(env('TEST_PLUGIN_MACHINE_TOKEN'));
    $this->artisan(GetPluginMachineJson::class, ['pluginId' => '2'])
         ->assertExitCode(0);
         expect(Helpers::pluginConfig()['pluginId'])->toEqual('2');

});

test('Get config based on pluginMachine.json', function () {
    Helpers::pluginConfig(['pluginId' => '22','buildId' => '120']);
    Http::fake([
        '*' => Http::response(['pluginId' => '22','buildId' => '122'], 200, []),
    ]);
    Helpers::token(env('TEST_PLUGIN_MACHINE_TOKEN'));
    $this->artisan(GetPluginMachineJson::class)
         ->assertExitCode(0);
         expect(Helpers::pluginConfig()['buildId'])->toEqual('122');

});
