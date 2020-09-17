<?php

namespace RebelWalls\LaravelProxicore\MessagePusher\Messages;

class OrderCreatedMessage extends BaseMessage
{
    protected $event = 'order-created';
}
