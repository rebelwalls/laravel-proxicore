<?php

namespace RebelWalls\LaravelProxicore\MessagePusher\Messages;

/**
 * Class ArticleCreatedMessage
 *
 * @package RebelWalls\LaravelProxicore\MessagePusher\Messages
 */
class ArticleCreatedMessage extends BaseMessage
{
    protected $event = 'ArticleCreated';
    protected $version = '1.0';
}
