<?php

namespace App\Providers;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\ServiceProvider;
use Rollbar\RollbarLogger;
use Rollbar\Rollbar;

class RollbarServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(RollbarLogger::class, function () {
            $config = $this->app->make(Repository::class);

            $defaults = [
                'environment' => app()->environment(),
                'root' => base_path(),
                'handle_exception' => true,
                'handle_error' => true,
                'handle_fatal' => true,
            ];

            $rollbarConfig = array_merge($defaults, $config->get('logging.channels.rollbar', []));

            $handleException = (bool)array_pull($rollbarConfig, 'handle_exception');
            $handleError = (bool)array_pull($rollbarConfig, 'handle_error');
            $handleFatal = (bool)array_pull($rollbarConfig, 'handle_fatal');

            Rollbar::init($rollbarConfig, $handleException, $handleError, $handleFatal);

            return Rollbar::logger();
        });
    }
}
