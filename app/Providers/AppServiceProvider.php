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

        //Resolve PluginMachine in container
        $this->app->bind( PluginMachine::class, function($app, array $parameters){
            $plugin = isset($parameters['plugin'])
                ? $parameters['plugin']
                : PluginMachinePlugin::fromArray(Helpers::pluginConfig());
            //create YourService passing a parameter got from the calling code
            return new PluginMachine(
                $app->make(PluginMachineApi::class),
                $plugin,
                Helpers::writePath()
            );
        } );



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
