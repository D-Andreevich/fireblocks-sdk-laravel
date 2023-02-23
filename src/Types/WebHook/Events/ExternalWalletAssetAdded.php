<?php

namespace FireblocksSdkLaravel\Types\WebHook\Events;


use FireblocksSdkLaravel\Types\Enums\EventTypesEnums;
use FireblocksSdkLaravel\Types\WebHook\Events\DataObjects\WalletAssetWebhook;

class ExternalWalletAssetAdded extends BaseEvent
{
    public function __construct(string $type = EventTypesEnums::_EXTERNAL_WALLET_ASSET_ADDED, string $tenantId, int $timestamp, array $data)
    {
        parent::__construct(EventTypesEnums::$type(), $tenantId, $timestamp, new WalletAssetWebhook(...$data));
    }

    /**
     * @return EventData<WalletAssetWebhook>
     */
    public function getData(): WalletAssetWebhook
    {
        return parent::getData();
    }


}