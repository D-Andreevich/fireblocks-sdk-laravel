<?php

namespace FireblocksSdkLaravel\Types\Enums;

class PeerEnums extends EnumCustom
{
    const VAULT_ACCOUNT      = "VAULT_ACCOUNT";
    const EXCHANGE_ACCOUNT   = "EXCHANGE_ACCOUNT";
    const INTERNAL_WALLET    = "INTERNAL_WALLET";
    const EXTERNAL_WALLET    = "EXTERNAL_WALLET";
    const UNKNOWN_PEER       = "UNKNOWN";
    const FIAT_ACCOUNT       = "FIAT_ACCOUNT";
    const NETWORK_CONNECTION = "NETWORK_CONNECTION";
    const COMPOUND           = "COMPOUND";
    const ONE_TIME_ADDRESS   = "ONE_TIME_ADDRESS";
}