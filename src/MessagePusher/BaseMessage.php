<?php

namespace RebelWalls\LaravelProxicore\MessagePusher;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Class Message
 *
 * @package RebelWalls\LaravelProxicore\EventPusher
 */
abstract class BaseMessage
{
    /**
     * @var string
     */
    protected $event;

    /**
     * @var array
     */
    private $payload;

    /**
     * @var string
     */
    private $traceId;

    /**
     * @var string
     */
    private $version;

    /**
     * @param string $traceId
     *
     * @return $this
     */
    public function setTraceId(string $traceId)
    {
        $this->traceId = $traceId;

        return $this;
    }

    /**
     * @return string
     */
    public function getTraceId()
    {
        $this->ensureTraceableIdIsSet();

        return $this->traceId;
    }

    /**
     * @param array $payload
     *
     * @return $this
     */
    public function setPayload(array $payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $this->ensureTraceableIdIsSet();

        if (empty($this->payload)) {
            Log::warning(
                sprintf(
                    'Payload for Proxicore Message [%s] was empty.',
                    $this->traceId
                ),
                ['traceId' => $this->traceId]
            );
        }

        return [
            'type' => $this->event,
            'traceId' => $this->traceId,
            'timestamp' => Carbon::now()->toDateTimeString(),
            'version' => '1.0',
            'payload' => $this->payload,
        ];
    }

    /**
     * If a traceable id is not set, create a backup traceable id.
     *
     * @return void
     */
    private function ensureTraceableIdIsSet()
    {
        if (empty($this->traceId)) {
            $this->traceId = Str::random(12);
        }
    }
}
