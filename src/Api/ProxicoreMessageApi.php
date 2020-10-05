<?php

namespace RebelWalls\LaravelProxicore\Api;

use RebelWalls\LaravelProxicore\MessagePusher\Messages\BaseMessage;

/**
 * Class ProxicoreMessageApi
 *
 * @package App\Integrations\Fortnox\Api
 */
class ProxicoreMessageApi extends ProxicoreApi
{
    /**
     * Api endpoint
     * @var
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
        return $this->call('POST', $this->endpoint, null, $message->toArray());
    }
}
