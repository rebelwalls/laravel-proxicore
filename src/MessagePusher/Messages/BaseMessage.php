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
    private $payload;

    /**
     * @var string
     */
    private $traceableId;

    /**
     * @var string
     */
    private $origin;

    /**
     * BaseMessage constructor.
     */
    public function __construct()
    {
        $origin = config('laravel-proxicore.origin');
        $this->setOrigin($origin);
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
            'origin' => $this->origin,
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
}
