<?php

namespace RebelWalls\LaravelProxicore\Calls;

use GuzzleHttp\Exception\GuzzleException;
use RebelWalls\LaravelProxicore\Api\ProxicoreApiResponse;
use RebelWalls\LaravelProxicore\Api\ProxicoreException;

/**
 * Class ProxicoreMessageApi
 *
 * @package App\Integrations\Fortnox\Api
 */
class ProxicoreGetPaymentStatusCall extends ProxicoreBaseCall
{
    /**
     * ProxicoreGetPaymentStatusCall constructor.
     */
    public function __construct()
    {
        $this->endpoint = $this->resolveEndpoint('getpaymentstatus');

        parent::__construct();
    }

    /**
     * @param string $customerNo
     *
     * @return ProxicoreApiResponse
     *
     * @throws ProxicoreException
     * @throws GuzzleException
     */
    public function getPaymentStatus(string $customerNo): ProxicoreApiResponse
    {
        return $this->call('GET', $this->endpoint, ['no' => $customerNo]);
    }
}
