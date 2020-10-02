<?php

namespace RebelWalls\LaravelProxicore\MessagePusher\Messages;

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
    private $traceableId;

    /**
     * @var string
     */
    private $version;

    /**
     * @param string $traceableId
     *
     * @return $this
     */
    public function setTraceableId(string $traceableId)
    {
        $this->traceableId = $traceableId;

        return $this;
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
            Log::warning('Payload for Proxicore Message [' . $this->traceableId . '] was empty.');
        }

        return [
            'type' => $this->event,
            'traceId' => $this->traceableId,
            'timestamp' => Carbon::now()->toDateTimeString(),
            'version' => '1.0',
            'payload' => $this->payload,
        ];
    }

    /**
     * If a traceable id is not set, create a backup traceable id.
     */
    private function ensureTraceableIdIsSet()
    {
        if (empty($this->traceableId)) {
            $this->traceableId = Str::random(12);
        }
    }
}
