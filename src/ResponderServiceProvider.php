<?php

namespace BrightComponents\Responder;

use BrightComponents\Responder\Commands\ResponderMakeCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ResponderServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/responders.php' => config_path('responders.php'),
        ]);

        $this->commands([
            ResponderMakeCommand::class,
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        //
    }
}
