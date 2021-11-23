<?php

use App\Services\PluginMachine;
use App\Services\PluginMachineApi;
use App\Services\PluginMachinePlugin;
use Illuminate\Support\Facades\Storage;

/**
test( 'PluginMachinePlugin', function() {

    $plugin = app( PluginMachinePlugin::class );
    $this->assertNotEmpty($plugin->pluginId);
    $this->assertNotEmpty($plugin->buildId);
});
test('Add feature', function(){
    $api = app( PluginMachineApi::class );
    $plugin = app( PluginMachinePlugin::class );
    $r = $api->addFeature(
        'adminPage',
        $plugin,
        [
            'adminPageName' => 'name',
            'adminPageTitle' => 'title',
            'adminPageType' => 'REACT',
        ]
    );
    $this->assertNotEmpty($r['id']);
    $this->assertNotEmpty($r['files']);


    foreach ($r['files'] as $file) {
        $codeR = $api->getFeatureCode(
            $r['id'],
            $plugin,
            $file
        );
        $this->assertNotEmpty($codeR);
    }

});

test('Add feature files', function(){
    $api = app( PluginMachineApi::class );
    $plugin = app( PluginMachinePlugin::class );
    $pluginMachine = app( PluginMachine::class );
    Storage::fake();
    $pluginMachine->addFeature(
        'adminPage',
        [
            'adminPageName' => 'name',
            'adminPageTitle' => 'title',
            'adminPageType' => 'REACT',
        ]
    );
    Storage::assertExists(
        $plugin->writePath('admin/name/App.js')
    );
    Storage::assertExists(
        $plugin->writePath('admin/name/App.js')
    );
});
test('Adds pluginMachine.json files', function(){
    Storage::fake();
    $pluginMachine = app( PluginMachine::class );

    $this->assertTrue($pluginMachine->writePluginJson(
        4
    ));

});
*/`
