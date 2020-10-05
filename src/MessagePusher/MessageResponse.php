<?php

namespace RebelWalls\LaravelProxicore\MessagePusher;

use RebelWalls\LaravelProxicore\Api\ProxicoreApiResponse;

/**
 * Class MessageResponse
 *
 * @package RebelWalls\LaravelProxicore\MessagePusher
 */
class MessageResponse
{
    /**
     * @var ProxicoreApiResponse $response
     */
    private $response;

    /**
     * MessageResponse constructor.
     *
     * @param ProxicoreApiResponse $response
     */
    public function __construct(ProxicoreApiResponse $response)
    {
        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return 'Temporary message that will be extracted from response.';
    }
}
