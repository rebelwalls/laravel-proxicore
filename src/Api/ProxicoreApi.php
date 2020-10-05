<?php

namespace RebelWalls\LaravelProxicore\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\stream_for;
use stdClass;

abstract class ProxicoreApi
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ProxicoreApi constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Responsible for making the final API call
     *
     * @param $method
     * @param $endpoint
     * @param null $params
     * @param null $payload
     *
     * @return mixed|stdClass
     *
     * @throws ProxicoreException
     * @throws GuzzleException
     */
    protected function call($method, $endpoint, $params = null, $payload = null)
    {
        try {
            $uri = $this->createUri($endpoint, $params);
            $options['headers'] = $this->createHeaders();

            if ($payload) {
                $options['body'] = stream_for(json_encode($payload));
            }

            $response = $this->client->request($method, $uri, $options);

            return $this->handleResponse($response);
        } catch (ClientException $exception) {
            throw new ProxicoreException($exception);
        }
    }

    /**
     * Compiles the API uri with the endpoint and optional parameters
     *
     * @param $endpoint
     * @param null $params
     *
     * @return mixed|string
     */
    private function createUri($endpoint, $params = null)
    {
        $uri = concat_uri(config('laravel-proxicore.endpoint'), $endpoint);

        if ($params) {
            $uri .= '/?' . http_build_query($params);
        }

        return $uri;
    }

    /**
     * Compiles the headerinformation with type, security etc
     *
     * @return array
     */
    private function createHeaders()
    {
        return [
//            'Access-Token' => // Add Access-Token,
//            'Client-Secret' => // Add Client-Secret,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    /**
     * Converts an API respons to a return object depending on content type
     *
     * @param Response $response
     *
     * @return ProxicoreApiResponse
     */
    private function handleResponse(Response $response)
    {
        return new ProxicoreApiResponse($response);
    }
}
