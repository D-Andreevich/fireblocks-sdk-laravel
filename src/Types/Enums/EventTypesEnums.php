<?php

namespace FireblocksSdkLaravel\Types\Enums;

use FireblocksSdkLaravel\Types\WebHook\Events\ExchangeAccountAdded;
use FireblocksSdkLaravel\Types\WebHook\Events\ExternalWalletAssetAdded;
use FireblocksSdkLaravel\Types\WebHook\Events\FiatAccountAdded;
use FireblocksSdkLaravel\Types\WebHook\Events\InternalWalletAssetAdded;
use FireblocksSdkLaravel\Types\WebHook\Events\NetworkConnectionAdded;
use FireblocksSdkLaravel\Types\WebHook\Events\TransactionApprovalStatusUpdated;
use FireblocksSdkLaravel\Types\WebHook\Events\TransactionCreated;
use FireblocksSdkLaravel\Types\WebHook\Events\TransactionStatusUpdated;
use FireblocksSdkLaravel\Types\WebHook\Events\VaultAccountAdded;
use FireblocksSdkLaravel\Types\WebHook\Events\VaultAccountAssetAdded;

class EventTypesEnums extends EnumCustom
{
    const _TRANSACTION_CREATED                 = 'TRANSACTION_CREATED';                //	Sent upon any new transaction identified in the workspace.
    const _TRANSACTION_STATUS_UPDATED          = 'TRANSACTION_STATUS_UPDATED';         //	Sent upon any change in the status of a transaction or number of confirmations update.
    const _TRANSACTION_APPROVAL_STATUS_UPDATED = 'TRANSACTION_APPROVAL_STATUS_UPDATED';//	Sent with every approval based on the Transaction Authorization Policy.
    const _VAULT_ACCOUNT_ADDED                 = 'VAULT_ACCOUNT_ADDED';                //	Sent upon addition of a new vault account in the workspace.
    const _VAULT_ACCOUNT_ASSET_ADDED           = 'VAULT_ACCOUNT_ASSET_ADDED';          //	Sent upon addition of a new asset under a vault account.
    const _INTERNAL_WALLET_ASSET_ADDED         = 'INTERNAL_WALLET_ASSET_ADDED';        //	Sent upon addition of a new asset under an internal wallet.
    const _EXTERNAL_WALLET_ASSET_ADDED         = 'EXTERNAL_WALLET_ASSET_ADDED';        //	Sent upon addition of a new asset under an external wallet.
    const _EXCHANGE_ACCOUNT_ADDED              = 'EXCHANGE_ACCOUNT_ADDED';             //	Sent upon addition of a new exchange account.
    const _FIAT_ACCOUNT_ADDED                  = 'FIAT_ACCOUNT_ADDED';                 //	Sent upon addition of a new fiat account.
    const _NETWORK_CONNECTION_ADDED            = 'NETWORK_CONNECTION_ADDED';           //	Sent upon addition of a new network connection.


    public static function getClass(EventTypesEnums $type): ?string
    {
        $associateEventToClass = [
            static::_TRANSACTION_CREATED                 => TransactionCreated::class,
            static::_TRANSACTION_STATUS_UPDATED          => TransactionStatusUpdated::class,
            static::_TRANSACTION_APPROVAL_STATUS_UPDATED => TransactionApprovalStatusUpdated::class,
            static::_VAULT_ACCOUNT_ADDED                 => VaultAccountAdded::class,
            static::_VAULT_ACCOUNT_ASSET_ADDED           => VaultAccountAssetAdded::class,
            static::_INTERNAL_WALLET_ASSET_ADDED         => InternalWalletAssetAdded::class,
            static::_EXTERNAL_WALLET_ASSET_ADDED         => ExternalWalletAssetAdded::class,
            static::_EXCHANGE_ACCOUNT_ADDED              => ExchangeAccountAdded::class,
            static::_FIAT_ACCOUNT_ADDED                  => FiatAccountAdded::class,
            static::_NETWORK_CONNECTION_ADDED            => NetworkConnectionAdded::class,
        ];
        return $associateEventToClass["$type"] ?? null;
    }
}