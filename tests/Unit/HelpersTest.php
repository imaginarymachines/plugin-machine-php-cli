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
