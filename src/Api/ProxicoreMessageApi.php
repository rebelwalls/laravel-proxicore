<?php

namespace RebelWalls\LaravelProxicore\Api;

use RebelWalls\LaravelProxicore\MessagePusher\BaseMessage;

/**
 * Class ProxicoreMessageApi
 *
 * @package App\Integrations\Fortnox\Api
 *
 * @property string $endpoint
 */
class ProxicoreMessageApi extends ProxicoreApi
{
    /**
     * Api endpoint
     */
    protected $endpoint = 'api/pegasus/v1.0/publishevent';

    /**
     * @param BaseMessage $message
     *
     * @return ProxicoreApiResponse
     *
     * @throws ProxicoreException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function push(BaseMessage $message)
    {
//        info('Pushing Proxicore Api call to [' . $this->endpoint . '] with payload: ' . json_encode($message->toArray(), JSON_PRETTY_PRINT), ['traceId' => $message->getTraceId()]);

        return $this->call('POST', $this->endpoint, null, $message->toArray());
    }
}
