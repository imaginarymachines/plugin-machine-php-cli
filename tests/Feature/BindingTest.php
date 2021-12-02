<?php
use App\Services\PluginMachineApi;
use App\Services\PluginMachine;
use App\Services\PluginMachinePlugin;

use App\Helpers;

//Is API available?
test('Binding PluginMachineApi', function () {
	expect(
		app()->make(PluginMachineApi::class)
	)->toBeInstanceOf(PluginMachineApi::class);
	expect(
		app(PluginMachineApi::class)
	)->toBeInstanceOf(PluginMachineApi::class);
});

//Can we get plugin and plugin machine from container?
test('Binding PluginMachine', function () {
	Helpers::pluginConfig([
		'pluginId' => '3','buildId' => '5','slug' => 'taco'
	]);
	$pluginMachine =app(PluginMachine::class);
	//Is plugin machine?
	expect(
		$pluginMachine
	)->toBeInstanceOf(PluginMachine::class);
	//Test machine's plugin loaded from config
	$plugin = $pluginMachine->plugin;
	expect(
		$plugin
	)->toBeInstanceOf(PluginMachinePlugin::class);
	expect($plugin->pluginId)->toEqual('3');
	expect($plugin->buildId)->toEqual('5');
	expect($plugin->slug)->toBe('taco');
});

//This is an e2e test for add and get via api
//It is skipped for now, because needs token set in CI.
test( 'Api', function(){
    $this->markTestSkipped('Needs token set in CI');
    //Get API from container
    $api = app()->make(PluginMachineApi::class);
    //Get Plugin Machien from container
    $pluginMachine =app(PluginMachine::class);
    //Add feature via API
    $r = $api->addFeature('block',$pluginMachine->plugin,[
        "blockName" => "two",
        "blockTitle" => "Two",
        "blockCategory" => "design",
        "blockRenderCallbackType" => "jsx",
        "blockBLOCK_DESCRIPTION" => "Block Two",
        "featureType" => "block"
    ]);
    //Check response
    $this->assertArrayHasKey('id',$r);
    $this->assertArrayHasKey('files',$r);
    //Get all the files
    foreach ($r['files'] as $file) {
        $api->getFeatureCode(
            $r['id'],
            $pluginMachine->plugin,
            $file
        );
    }
    //Test if files written

})->group( 'api:real');
