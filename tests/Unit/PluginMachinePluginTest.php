<?php
use App\Services\PluginMachinePlugin;
use App\Helpers;
test( 'Gets from saved', function() {
    Helpers::pluginConfig([
        'pluginId' => '5',
        'buildId' => '1',
        'buildIncludes' => [],
        'slug' => 'slugo'
    ]);
    $pluginMachinePlugin = PluginMachinePlugin::fromArray(
        Helpers::pluginConfig()
    );
    expect($pluginMachinePlugin->buildId())->toBe(1);
    expect($pluginMachinePlugin->pluginId)->toBe(5);

});
