<?php

namespace RebelWalls\LaravelProxicore\Calls;

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
     * @param string $customerNo
     *
     * @return ProxicoreApiResponse
     *
     * @throws ProxicoreException
     */
    public function getPaymentStatus(string $customerNo): ProxicoreApiResponse
    {
        return $this->get('getpaymentstatus', ['no' => $customerNo]);
    }
}
