<?php

namespace FireblocksSdkLaravel\Types\WebHook\Events;

use FireblocksSdkLaravel\Types\Enums\EventTypesEnums;

abstract class BaseEvent
{
    private EventTypesEnums $type;
    private string          $tenantId;
    private int             $timestamp;
    private EventData       $data;


    public function __construct(EventTypesEnums $type, string $tenantId, int $timestamp, EventData $data)
    {
        $this->type      = $type;
        $this->tenantId  = $tenantId;
        $this->timestamp = $timestamp;
        $this->data      = $data;
    }

    /**
     * @return EventTypesEnums
     */
    public function getType(): EventTypesEnums
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @return EventData
     */
    public function getData(): EventData
    {
        return $this->data;
    }


}