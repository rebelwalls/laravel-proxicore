<?php

namespace RebelWalls\LaravelProxicore\Calls;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use RebelWalls\LaravelProxicore\Api\ProxicoreException;

/**
 * Class ProxicoreMessageApi
 *
 * @package App\Integrations\Fortnox\Api
 */
class ProxicoreGetCustomerCall extends ProxicoreBaseCall
{
    /**
     * Api endpoint
     * @var
     */
    protected $endpoint = 'api/pegasus/v1.0/businesscentral/getcustomer';

    /**
     * @param string $customerNo
     *
     * @return mixed
     *
     * @throws ProxicoreException
     * @throws GuzzleException
     */
    public function getPaymentStatus(string $customerNo)
    {
        $proxicoreResponse = $this->call('GET', $this->endpoint, ['No' => $customerNo]);

        switch ($proxicoreResponse->getStatus()) {
            case 'success':
                return $proxicoreResponse->getPayload();
            case 'failure':
                Log::error('Failed to retrieve customer [' . $customerNo . ']');
                Log::error('Message revieved: [' . $proxicoreResponse->getMessage() . ']');
            case 'error':
            default:
                Log::emergency('Error when trying to retrieve customer [' . $customerNo . ']');
                Log::emergency('Message revieved: [' . $proxicoreResponse->getMessage() . ']');
        }

        // If we get to this point, there has either been a failure
        // or an error. This has been logged, return null values for frontend to handle.
        return [
            'customer' => 'unknown'
        ];
    }
}
