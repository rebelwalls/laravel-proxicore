<?php

namespace RebelWalls\LaravelProxicore\MessagePusher;

/**
 * Class MessageResponse
 *
 * @package RebelWalls\LaravelProxicore\MessagePusher
 */
class MessageResponse
{
    /**
     * @var string $rawResponse
     */
    private $rawResponse;

    /**
     * MessageResponse constructor.
     *
     * @param string $rawResponse
     */
    public function __construct(string $rawResponse)
    {
        $this->rawResponse = $rawResponse;
    }
}
