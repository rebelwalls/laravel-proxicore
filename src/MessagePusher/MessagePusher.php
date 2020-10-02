<?php

namespace RebelWalls\LaravelProxicore\MessagePusher;

use Illuminate\Support\Facades\Log;
use RebelWalls\LaravelProxicore\MessagePusher\Messages\BaseMessage;

/**
 * Class MessagePusher
 *
 * @package RebelWalls\LaravelProxicore\MessagePusher
 */
class MessagePusher
{
    /**
     * @var BaseMessage
     */
    private $message;

    /**
     * MessagePusher constructor.
     *
     * @param BaseMessage $message
     */
    public function __construct(BaseMessage $message)
    {
        $this->message = $message;
    }

    /**
     * @return MessageResponse
     */
    public function push()
    {
        $endpoint = config('laravel-proxicore.endpoint');
        $endpoint .= 'api/pegasus/v1.0/publishevent';

        $response = $this->post($endpoint, $this->message->toArray());

        return new MessageResponse($response);
    }

    /**
     * Making a POST call to supplied endpoint, using curl functions
     *
     * @param string $endpoint
     * @param array $payload
     *
     * @return mixed
     */
    private function post(string $endpoint, array $payload = [])
    {
        $url = $endpoint;

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($payload));
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($c);

        if (!$response) {
            Log::error('ErrNo: ' . curl_errno($c) . ', Err: ' . curl_error($c));
        }

        curl_close($c);

        return $response;
    }
}
