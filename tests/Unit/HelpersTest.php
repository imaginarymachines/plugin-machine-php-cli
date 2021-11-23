<?php
use App\Helpers;
test('Helpers sets token', function () {
    Helpers::token('test-token');
    expect(Helpers::token())->toEqual('test-token');
});
