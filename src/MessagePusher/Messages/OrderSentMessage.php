<?php

namespace RebelWalls\LaravelProxicore\MessagePusher\Messages;

/**
 * Class OrderCreatedMessage
 *
 * @package RebelWalls\LaravelProxicore\MessagePusher\Messages
 */
class OrderSentMessage extends BaseMessage
{
    protected $event = 'OrderSent';
    protected $version = '1.0';
}
