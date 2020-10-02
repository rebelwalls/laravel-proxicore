<?php

namespace RebelWalls\LaravelProxicore\MessagePusher\Messages;

/**
 * Class CustomerUpdatedMessage
 *
 * @package RebelWalls\LaravelProxicore\MessagePusher\Messages
 */
class CustomerUpdatedMessage extends BaseMessage
{
    protected $event = 'CustomerUpdated';
    protected $version = '1.0';
}
