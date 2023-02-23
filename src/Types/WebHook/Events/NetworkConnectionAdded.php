<?php

namespace FireblocksSdkLaravel\Types\WebHook\Events;


use FireblocksSdkLaravel\Types\Enums\EventTypesEnums;
use FireblocksSdkLaravel\Types\WebHook\Events\DataObjects\NetworkConnection;

class NetworkConnectionAdded extends BaseEvent
{
    public function __construct(string $type = EventTypesEnums::_NETWORK_CONNECTION_ADDED,string $tenantId, int $timestamp, array $data)
    {
        parent::__construct(EventTypesEnums::$type(), $tenantId, $timestamp, new NetworkConnection(...$data));
    }

    /**
     * @return EventData<NetworkConnection>
     */
    public function getData(): NetworkConnection
    {
        return parent::getData();
    }


}