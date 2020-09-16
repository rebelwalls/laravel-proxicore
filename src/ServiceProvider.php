<?php

namespace RebelWalls\LaravelProxicore;

class LaravelProxicoreService extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel-proxicore.php', 'laravel-proxicore'
        );
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-proxicore.php' => config_path('laravel-proxicore.php'),
        ]);
    }
}
