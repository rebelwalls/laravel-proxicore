<?php

declare(strict_types=1);

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
    protected string $endpoint = 'publishevent';

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
        return $this->post($this->endpoint, [], $message->toArray());
    }
}
