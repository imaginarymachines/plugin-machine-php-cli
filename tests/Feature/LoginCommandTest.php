<?php
use App\Helpers;
test('inspiring command', function () {
    $this->artisan('login token-2')
         ->assertExitCode(0);
         expect(Helpers::token())->toEqual('token-2');

});
