<?php

namespace FireblocksSdkLaravel\Types\WebHook\Events;


use FireblocksSdkLaravel\Types\Enums\EventTypesEnums;
use FireblocksSdkLaravel\Types\WebHook\Events\DataObjects\VaultAccount;

class VaultAccountAdded extends BaseEvent
{
    public function __construct(string $type = EventTypesEnums::_VAULT_ACCOUNT_ADDED, string $tenantId, int $timestamp, array $data)
    {
        parent::__construct(EventTypesEnums::$type(), $tenantId, $timestamp, new VaultAccount(...$data));
    }

    /**
     * @return VaultAccount
     */
    public function getData(): VaultAccount
    {
        return parent::getData();
    }


}