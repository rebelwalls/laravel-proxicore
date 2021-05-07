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
    private $message;

    /**
     * @var string
     */
    private $payload;

    /**
     * @var string
     */
    private $status;

    /**
     * ProxicoreApiResponse constructor.
     *
     * @param Response $response
     *
     * @throws ProxicoreException
     */
    public function __construct(Response $response)
    {
        $this->rawResponse = $response;

        $this->handle();
    }

    /**
     * Handle response
     *
     * @throws ProxicoreException
     *
     * @return void
     */
    private function handle()
    {
        $responseObject = json_decode($this->rawResponse->getBody()->getContents(), true);

        if (!array_key_exists('status', $responseObject) || !array_key_exists('payload', $responseObject)) {
            throw new ProxicoreException('Response from Proxicore did not contain needed information.');
        }

        $this->status = $responseObject['status'];
        $this->payload = $responseObject['payload'];
        $this->message = isset($responseObject['message']) ? $responseObject['message'] : '';
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return boolean
     */
    public function success()
    {
        return $this->getStatus() === 'success';
    }
}
