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
