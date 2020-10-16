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
     * @var string
     */
    protected $endpointTarget = 'getpaymentstatus';

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
        return $this->call('GET', $this->endpoint, ['No' => $customerNo]);
    }
}
