<?php

namespace RebelWalls\LaravelProxicore\Api;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
     * Responsible for making the final API call
     *
     * @param string $method
     * @param string $endpoint
     * @param array $parameters
     * @param null $payload
     *
     * @return mixed|stdClass
     *
     * @throws ProxicoreException
     */
    protected function call(string $method, string $endpoint, $parameters = [], $payload = null)
    {
        try {
            $uri = $this->createUri($endpoint, $parameters);
            $request = Http::withHeaders($this->createHeaders());
            $payload = Arr::wrap($payload);

            switch (strtolower($method)) {
                case 'post':
                    $response = $request->post($uri, $payload);
                    break;
                case 'get':
                    $response = $request->get($uri, $payload);
                    break;
                case 'put':
                    $response = $request->put($uri, $payload);
                    break;
                case 'patch':
                    $response = $request->patch($uri, $payload);
                    break;
                case 'delete':
                    $response = $request->delete($uri, $payload);
                    break;
                default:
                    throw new ProxicoreException("HTTP method `$method` is not supported");
            }

            if ($response->failed()) {
                $response->throw();
            }
            $responseObject = $this->handleResponse($response->toPsrResponse());

            $this->handleLog($responseObject, $parameters, $method, $endpoint);

            return $responseObject;
        } catch (RequestException $exception) {
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
    protected string $endpoint;

    /**
     * Compiles the API uri with the endpoint and optional parameters
     *
     * @param string $endpoint
     * @param null $params
     *
     * @return string
     */
    private function createUri(string $endpoint, $params = null)
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
     *
     * @return void
     */
    protected function handleLog(
        ProxicoreApiResponse $responseObject,
        array $parameters,
        string $method,
        string $endpoint
    ): void {
        try {
            $parameterString = collect($parameters)
                ->transform(function ($value, $key) {
                    return $key . ' => ' . $value;
                })
                ->implode(', ');

            $contextString = "Method: [$method] Endpoint: [$endpoint] Parameters: [$parameterString]";

            switch ($responseObject->getStatus()) {
                case 'success':
                    Log::debug('Got a success response from Proxicore. ' . $contextString);
                    Log::debug('Message received: [' . $responseObject->getMessage() . ']');
                    break;
                case 'failure':
                    Log::debug('Got a failure response from Proxicore. ' . $contextString);
                    Log::debug('Message received: [' . $responseObject->getMessage() . ']');
                    break;
                case 'error':
                default:
                    Log::error('Got an error response from Proxicore [' . $contextString . ']');
                    Log::error('Message received: [' . $responseObject->getMessage() . ']');
                    break;
            }
        } catch (Exception $exception) {
            Log::warning('Error parsing log message from Proxicore: ' . $endpoint);
        }
    }
}
