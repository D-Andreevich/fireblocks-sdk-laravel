<?php

namespace FireblocksSdkLaravel\Types\Enums;

class TransactionOperationEnums extends EnumCustom
{
    const _BURN                 = 'BURN';
    const _CONTRACT_CALL        = 'CONTRACT_CALL';
    const _MINT                 = 'MINT';
    const _RAW                  = 'RAW';
    const _REDEEM_FROM_COMPOUND = 'REDEEM_FROM_COMPOUND';
    const _SUPPLY_TO_COMPOUND   = 'SUPPLY_TO_COMPOUND';
    const _TRANSFER             = 'TRANSFER';
    const _TYPED_MESSAGE        = 'TYPED_MESSAGE';
}