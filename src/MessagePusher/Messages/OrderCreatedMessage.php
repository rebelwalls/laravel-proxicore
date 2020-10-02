<?php

namespace RebelWalls\LaravelProxicore\MessagePusher\Messages;

/**
 * Class OrderCreatedMessage
 *
 * @package RebelWalls\LaravelProxicore\MessagePusher\Messages
 */
class OrderCreatedMessage extends BaseMessage
{
    protected $event = 'OrderCreated';
    protected $version = '1.0';
}
