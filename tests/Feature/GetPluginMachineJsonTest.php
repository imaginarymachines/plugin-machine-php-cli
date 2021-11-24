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
