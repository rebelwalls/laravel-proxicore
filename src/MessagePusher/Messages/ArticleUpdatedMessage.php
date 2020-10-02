<?php

namespace RebelWalls\LaravelProxicore\MessagePusher\Messages;

/**
 * Class ArticleUpdatedMessage
 *
 * @package RebelWalls\LaravelProxicore\MessagePusher\Messages
 */
class ArticleUpdatedMessage extends BaseMessage
{
    protected $event = 'ArticleUpdated';
    protected $version = '1.0';
}
