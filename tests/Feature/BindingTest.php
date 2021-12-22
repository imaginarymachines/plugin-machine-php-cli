<?php
use App\Services\PluginMachineApi;
use App\Services\PluginMachine;
use App\Services\PluginMachinePlugin;
use Illuminate\Support\Facades\Storage;
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
    $delete = function( ){
        collect(Storage::allFiles( Helpers::writePath()))
        ->map(function($file) {
            Storage::delete($file);
        });
    };
    //dd(Helpers::pluginConfig());
    $this->markTestSkipped('Needs token set in CI');
    $delete();
    //Get API from container
    $api = app()->make(PluginMachineApi::class);
    //Get Plugin Machien from container
    $pluginMachine = app(PluginMachine::class);
    //Add feature via API
    $r  =(array) $pluginMachine->addFeature('block',[
        "blockName" => "two",
        "blockTitle" => "Two",
        "blockCategory" => "design",
        "blockRenderCallbackType" => "jsx",
        "blockBLOCK_DESCRIPTION" => "Block Two",
        "featureType" => "block"
    ]);

    $this->assertArrayHasKey('files',$r);
    $this->assertArrayHasKey('main',$r);
    $files = array_flip($r['files']);
    $this->assertArrayHasKey('package.json',$files);
    $this->assertArrayHasKey('blocks/two/index.js',$files);
    $this->assertArrayHasKey('pluginMachine.json',$files);
    $this->assertTrue(Storage::exists( Helpers::writePath('/package.json')));
    $this->assertTrue(Storage::exists( Helpers::writePath('/blocks/two/index.js')));
    $delete();

})->group( 'api:real');
