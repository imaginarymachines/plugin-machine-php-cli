<?php
use App\Helpers;

test('Helpers sets token', function () {
	Helpers::token('test-token');
	expect(Helpers::token())->toEqual('test-token');
});

test('Helpers sets pluginConfig', function () {
	Helpers::pluginConfig([
		'pluginId' => '3'
	]);
	expect(Helpers::pluginConfig()['pluginId'])->toEqual('3');
});

test('write path', function () {
    $path = env('PLUGIN_MACHINE_WRITE_PATH') ??'/';
	expect($path)
        ->toEqual(Helpers::writePath());
	expect( $path .'r.php')
        ->toEqual(
            Helpers::writePath(
                'r.php',
            )
	);
});
