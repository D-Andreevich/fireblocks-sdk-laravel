<?php

namespace FireblocksSdkLaravel\Types\Enums;

class PeerEnums extends EnumCustom
{
    const _VAULT_ACCOUNT      = "VAULT_ACCOUNT";
    const _EXCHANGE_ACCOUNT   = "EXCHANGE_ACCOUNT";
    const _INTERNAL_WALLET    = "INTERNAL_WALLET";
    const _EXTERNAL_WALLET    = "EXTERNAL_WALLET";
    const _UNKNOWN_PEER       = "UNKNOWN";
    const _UNKNOWN            = "UNKNOWN";
    const _FIAT_ACCOUNT       = "FIAT_ACCOUNT";
    const _NETWORK_CONNECTION = "NETWORK_CONNECTION";
    const _COMPOUND           = "COMPOUND";
    const _ONE_TIME_ADDRESS   = "ONE_TIME_ADDRESS";
}