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
    public function __construct($rawResponse)
    {
        $this->rawResponse = $rawResponse;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return 'Temporary message that will be extracted from response.';
    }
}
