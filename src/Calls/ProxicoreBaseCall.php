<?php

namespace RebelWalls\LaravelProxicore\Calls;

use RebelWalls\LaravelProxicore\Api\ProxicoreApi;

/**
 * Class ProxicoreBaseCall
 *
 * @package App\Integrations\Fortnox\Api
 *
 * @property string $endpoint
 */
abstract class ProxicoreBaseCall extends ProxicoreApi
{
    /**
     * @var string
     */
    protected $endpointTarget;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @param string $endpointTarget
     *
     * @return string
     */
    protected function resolveEndpoint(string $endpointTarget): string
    {
        return 'api/' . config('laravel-proxicore.origin') . '/v1.0/businesscentral/' . $endpointTarget;
    }
}
