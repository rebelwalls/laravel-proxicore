<?php

namespace RebelWalls\LaravelProxicore\MessagePusher;

use RebelWalls\LaravelProxicore\MessagePusher\Messages\BaseMessage;

class MessagePusher
{
    /**
     * @var BaseMessage
     */
    private $message;

    public function __construct(BaseMessage $message)
    {
        $this->message = $message;

        $origin = config('laravel-proxicore.origin');
        $this->message->setOrigin($origin);
    }

    public function push()
    {
        // Post the message
    }
}
