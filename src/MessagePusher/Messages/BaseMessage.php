<?php

namespace RebelWalls\LaravelProxicore\MessagePusher\Messages;

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
    protected $payload;

    /**
     * @var string
     */
    protected $traceableId;

    /**
     * @var string
     */
    private $origin;

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
            'event' => $this->event,
            'traceableId' => $this->traceableId,
            'payload' => json_encode($this->payload),
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

    /**
     * @param string $origin
     *
     * @return $this
     */
    public function setOrigin(string $origin)
    {
        $this->origin = $origin;

        return $this;
    }
}
