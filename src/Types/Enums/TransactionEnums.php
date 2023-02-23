<?php

namespace FireblocksSdkLaravel\Types\Enums;

class TransactionEnums extends EnumCustom
{
    const _TRANSFER             = "TRANSFER";
    const _MINT                 = "MINT";
    const _BURN                 = "BURN";
    const _SUPPLY_TO_COMPOUND   = "SUPPLY_TO_COMPOUND";
    const _REDEEM_FROM_COMPOUND = "REDEEM_FROM_COMPOUND";
    const _RAW                  = "RAW";
    const _CONTRACT_CALL        = "CONTRACT_CALL";
    const _ONE_TIME_ADDRESS     = "ONE_TIME_ADDRESS";
}