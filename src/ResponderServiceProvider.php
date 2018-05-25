<?php

namespace BrightComponents\Responder;

use BrightComponents\Responder\Commands\ResponderMakeCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ResponderServiceProvider extends BaseServiceProvider
{
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
}
