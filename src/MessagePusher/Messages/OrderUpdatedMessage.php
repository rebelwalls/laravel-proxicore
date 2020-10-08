<?php

namespace RebelWalls\LaravelProxicore\MessagePusher\Messages;

/**
 * Class OrderCreatedMessage
 *
 * @package RebelWalls\LaravelProxicore\MessagePusher\Messages
 */
class OrderUpdatedMessage extends BaseMessage
{
    protected $event = 'OrderUpdated';
    protected $version = '1.0';
}
