<?php

namespace RebelWalls\LaravelProxicore\Api;

use GuzzleHttp\Psr7\Response;

/**
 * Class ProxicoreApiResponse
 *
 * @package RebelWalls\LaravelProxicore\Api
 */
class ProxicoreApiResponse
{
    /**
     * @var Response
     */
    private $rawResponse;

    /**
     * @var string
     */
    private $content;

    /**
     * ProxicoreApiResponse constructor.
     *
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->rawResponse = $response;

        $this->handle();
    }

    /**
     * Handle response
     */
    private function handle()
    {
        $this->content = $this->rawResponse->getBody()->getContents();
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
