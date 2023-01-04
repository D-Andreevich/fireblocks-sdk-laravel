<?php

namespace FireblocksSdkLaravel\Types\Enums;

class TransactionEnums extends EnumCustom
{
    const TRANSFER             = "TRANSFER";
    const MINT                 = "MINT";
    const BURN                 = "BURN";
    const SUPPLY_TO_COMPOUND   = "SUPPLY_TO_COMPOUND";
    const REDEEM_FROM_COMPOUND = "REDEEM_FROM_COMPOUND";
    const RAW                  = "RAW";
    const CONTRACT_CALL        = "CONTRACT_CALL";
    const ONE_TIME_ADDRESS     = "ONE_TIME_ADDRESS";
}