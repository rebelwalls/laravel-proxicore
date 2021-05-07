<?php

namespace RebelWalls\LaravelProxicore\MessagePusher;

use Illuminate\Support\Facades\Log;
use RebelWalls\LaravelProxicore\Api\ProxicoreMessageApi;
use Throwable;

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
     */
    public function push()
    {
        try {
            $response = $this->api->push($this->message);

            return new MessageResponse($response);
        } catch (Throwable $throwable) {
            Log::emergency(
                sprintf(
                    'Unable to send message to Proxicore. Message returned in Proxicore response: [%s]',
                    $throwable->getMessage()
                )
            );
        }
    }
}
