<?php

declare(strict_types=1);

namespace RebelWalls\LaravelProxicore\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return string[]
     */
    protected function getPackageProviders($app)
    {
        return [
            "RebelWalls\\LaravelProxicore\\ServiceProvider",
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function resolveApplicationConfiguration($app)
    {
        parent::resolveApplicationConfiguration($app);

        $app['config']->set('laravel-proxicore.endpoint', 'http://api.test/');
        $app['config']->set('laravel-proxicore.origin', 'cronos');
    }
}
