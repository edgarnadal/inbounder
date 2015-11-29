<?php

namespace Inbounder;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class InbounderServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $configFilePath = __DIR__ . '../config/inbounder.php';

        $this->publishes([
            $configFilePath => config_path('inbounder.php'),
        ]);

        $this->mergeConfigFrom($configFilePath, 'inbounder');
    }
}