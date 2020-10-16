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
     * ProxicoreBaseCall constructor.
     */
    public function __construct()
    {
        $this->endpoint = 'api/' . config('laravel-proxicore.origin') . '/v1.0/businesscentral/' . $this->endpointTarget;

        parent::__construct();
    }
}
