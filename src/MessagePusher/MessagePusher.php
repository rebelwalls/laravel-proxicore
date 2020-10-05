<?php

namespace RebelWalls\LaravelProxicore\MessagePusher;

use GuzzleHttp\Exception\GuzzleException;
use RebelWalls\LaravelProxicore\Api\ProxicoreException;
use RebelWalls\LaravelProxicore\Api\ProxicoreMessageApi;
use RebelWalls\LaravelProxicore\MessagePusher\Messages\BaseMessage;

/**
 * Class MessagePusher
 *
 * @package RebelWalls\LaravelProxicore\MessagePusher
 */
class MessagePusher
{
    /**
     * @var BaseMessage
     */
    private $message;
    /**
     * @var ProxicoreMessageApi
     */
    private $api;

    /**
     * MessagePusher constructor.
     *
     * @param BaseMessage $message
     */
    public function __construct(BaseMessage $message)
    {
        $this->message = $message;
        $this->api = new ProxicoreMessageApi();
    }

    /**
     * @return MessageResponse
     *
     * @throws GuzzleException
     * @throws ProxicoreException
     */
    public function push()
    {
        $response = $this->api->push($this->message);

        return new MessageResponse($response);
    }
}
