<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers;
use App\Services\Features;
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
        //Check if we have rules
        $hasRules = file_exists(app_path(Features::PATH_RULES));
        //sync command should work without Features service.
        if( $hasRules ) {
            $this->app->bind(Features::class, function () {
                return new Features(
                    (array) json_decode(
                        file_get_contents(app_path(Features::PATH_RULES))
                    ),
                    (array) json_decode(
                        file_get_contents(app_path(Features::PATH_FEATURES))
                    ),
                );
            });
        }

        //Put plugin machine API in container
		$this->app->bind(PluginMachineApi::class, function () {
			return new PluginMachineApi(
				Helpers::apiUrl(),
				Helpers::token()
			);
		});


		//Resolve PluginMachine in container
		$this->app->bind(PluginMachine::class, function ($app, array $parameters) {
			$plugin = isset($parameters['plugin'])
				? $parameters['plugin']
				: PluginMachinePlugin::fromArray(Helpers::pluginConfig());
			return new PluginMachine(
				$app->make(PluginMachineApi::class),
				$plugin,
				Helpers::writePath()
			);
		});

        //Configure logging channel
        //https://laravel-zero.com/docs/logging#note-on-phar-build
        config(['logging.channels.single.path' => \Phar::running()
            ? dirname(\Phar::running(false)) . '/plugin-machine.log'
            : storage_path('logs/plugin-machine.log')
        ]);
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
