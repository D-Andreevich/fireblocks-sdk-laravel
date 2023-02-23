<?php

namespace FireblocksSdkLaravel\Types\WebHook\Events;


use FireblocksSdkLaravel\Types\Enums\EventTypesEnums;
use FireblocksSdkLaravel\Types\WebHook\Events\DataObjects\AssetAddedData;
use FireblocksSdkLaravel\Types\WebHook\Events\DataObjects\VaultAccount;

class VaultAccountAssetAdded extends BaseEvent
{
    public function __construct(string $type = EventTypesEnums::_VAULT_ACCOUNT_ASSET_ADDED,string $tenantId, int $timestamp, array $data)
    {
        parent::__construct(EventTypesEnums::$type(), $tenantId, $timestamp, new AssetAddedData(...$data));
    }

    /**
     * @return EventData<AssetAddedData>
     */
    public function getData(): AssetAddedData
    {
        return parent::getData();
    }


}