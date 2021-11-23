<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Storage;
class PutFile extends Command
{

    protected $signature = 'file:put';


    protected $description = 'Test that we can put a local file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Storage::put("test.txt", "Test");

    }


}
