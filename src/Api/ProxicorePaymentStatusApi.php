<?php

namespace RebelWalls\LaravelProxicore\Api;

/**
 * Class ProxicoreMessageApi
 *
 * @package App\Integrations\Fortnox\Api
 */
class ProxicorePaymentStatusApi extends ProxicoreApi
{
    /**
     * Api endpoint
     * @var
     */
    protected $endpoint = 'api/pegasus/v1.0/businesscentral/getpaymentstatus';

    /**
     * @param string $customerNo
     *
     * @return ProxicoreApiResponse
     *
     * @throws ProxicoreException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPaymentStatus(string $customerNo)
    {
        $proxicoreResponse = $this->call('GET', $this->endpoint, ['No' => $customerNo]);

        return json_decode($proxicoreResponse->getContent(), true);
    }
}
