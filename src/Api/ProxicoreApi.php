<?php

namespace RebelWalls\LaravelProxicore\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Log;
use function GuzzleHttp\Psr7\stream_for;
use stdClass;

/**
 * Class ProxicoreApi
 *
 * @package RebelWalls\LaravelProxicore\Api
 *
 * @property Client $client
 */
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
     * @param array $parameters
     * @param null $payload
     *
     * @return mixed|stdClass
     *
     * @throws ProxicoreException
     */
    protected function call($method, $endpoint, $parameters = [], $payload = null)
    {
        try {
            $uri = $this->createUri($endpoint, $parameters);
            $options['headers'] = $this->createHeaders();

            if ($payload) {
                $options['body'] = stream_for(json_encode($payload));
            }

            $response = $this->client->request($method, $uri, $options);
            $responseObject = $this->handleResponse($response);

            $this->handleLog($responseObject, $parameters, $method, $endpoint);

            return $responseObject;
        } catch (ClientException $exception) {
            throw new ProxicoreException($exception->getMessage());
        } catch (GuzzleException $exception) {
            throw new ProxicoreException($exception->getMessage());
        }
    }

    /**
     * @param string $endpoint
     * @param array $parameters
     * @param null $payload
     *
     * @return ProxicoreApiResponse
     *
     * @throws ProxicoreException
     */
    protected function get(string $endpoint, $parameters = [], $payload = null): ProxicoreApiResponse
    {
        return $this->call('GET', $endpoint, $parameters, $payload);
    }

    /**
     * @param string $endpoint
     * @param array $parameters
     * @param null $payload
     *
     * @return ProxicoreApiResponse
     *
     * @throws ProxicoreException
     */
    protected function post(string $endpoint, $parameters = [], $payload = null): ProxicoreApiResponse
    {
        return $this->call('POST', $endpoint, $parameters, $payload);
    }

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * Compiles the API uri with the endpoint and optional parameters
     *
     * @param $endpoint
     * @param null $params
     *
     * @return string
     */
    private function createUri($endpoint, $params = null)
    {
        $uri = concat_uri(
            config('laravel-proxicore.endpoint'),
            'api',
            config('laravel-proxicore.origin'),
            'v1.0',
            $endpoint
        );

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
     * Converts an API response to a return object depending on content type
     *
     * @param Response $response
     *
     * @return ProxicoreApiResponse
     * @throws ProxicoreException
     */
    private function handleResponse(Response $response): ProxicoreApiResponse
    {
        return new ProxicoreApiResponse($response);
    }

    /**
     * @param ProxicoreApiResponse $responseObject
     * @param array $parameters
     * @param string $method
     * @param string $endpoint
     */
    protected function handleLog(ProxicoreApiResponse $responseObject, array $parameters, string $method, string $endpoint): void
    {
        $parameterString = collect($parameters)
            ->transform(function ($value, $key) {
                return $key . ' => ' . $value;
            })
            ->implode(', ');

        $contextString = 'Method: [' . $method . '] Endpoint: [' . $endpoint . '] Parameters: [' . $parameterString . ']';

        switch ($responseObject->getStatus()) {
            case 'success':
                info('Got a success response from Proxicore. ' . $contextString);
                info('Message received: [' . $responseObject->getMessage() . ']');
                break;
            case 'failure':
                Log::error('Got a failure response from Proxicore. ' . $contextString);
                Log::error('Message received: [' . $responseObject->getMessage() . ']');
                break;
            case 'error':
            default:
                Log::emergency('Got an error response from Proxicore [' . $contextString . ']');
                Log::emergency('Message received: [' . $responseObject->getMessage() . ']');
                break;
        }
    }
}
