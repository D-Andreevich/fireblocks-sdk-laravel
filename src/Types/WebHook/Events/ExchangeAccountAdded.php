<?php

namespace FireblocksSdkLaravel\Types\WebHook\Events;


use FireblocksSdkLaravel\Types\Enums\EventTypesEnums;
use FireblocksSdkLaravel\Types\WebHook\Events\DataObjects\ThirdPartyWebhook;

class ExchangeAccountAdded extends BaseEvent
{
    public function __construct(string $type = EventTypesEnums::_EXCHANGE_ACCOUNT_ADDED, string $tenantId, int $timestamp, array $data)
    {
        parent::__construct(EventTypesEnums::$type(), $tenantId, $timestamp, new ThirdPartyWebhook(...$data));
    }

    /**
     * @return ThirdPartyWebhook
     */
    public function getData(): ThirdPartyWebhook
    {
        return parent::getData();
    }

}