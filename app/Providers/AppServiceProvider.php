<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers;
use App\Services\PluginMachine;
use App\Services\PluginMachineApi;
use App\Services\PluginMachinePlugin;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Put plugin machine API in container
        $this->app->bind( PluginMachineApi::class, function(){
			return new PluginMachineApi(
				Helpers::apiUrl(),
				Helpers::token()
			);
		});



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
