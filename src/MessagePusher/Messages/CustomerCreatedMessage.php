<?php

namespace RebelWalls\LaravelProxicore\MessagePusher\Messages;

/**
 * Class CustomerCreatedMessage
 *
 * @package RebelWalls\LaravelProxicore\MessagePusher\Messages
 */
class CustomerCreatedMessage extends BaseMessage
{
    protected $event = 'CustomerCreated';
    protected $version = '1.0';
}
