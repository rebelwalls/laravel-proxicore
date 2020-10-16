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
class ProxicoreGetCustomerCall extends ProxicoreBaseCall
{
    /**
     * @var string
     */
    protected $endpointTarget = 'getcustomer';

    /**
     * @param string $customerNo
     *
     * @return mixed
     *
     * @throws ProxicoreException
     * @throws GuzzleException
     */
    public function getCustomer(string $customerNo): ProxicoreApiResponse
    {
        return $this->call('GET', $this->endpoint, ['No' => $customerNo]);
    }
}
