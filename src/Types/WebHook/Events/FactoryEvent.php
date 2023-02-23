<?php

namespace FireblocksSdkLaravel\Types\WebHook\Events;

use FireblocksSdkLaravel\Types\Enums\EventTypesEnums;

class FactoryEvent
{
    static public function get(string $type, string $tenantId, int $timestamp, array $data): BaseEvent
    {
        $className = EventTypesEnums::getClass(EventTypesEnums::$type());

        return new $className($type, $tenantId, $timestamp, $data);
    }
}