<?php

namespace FireblocksSdkLaravel\Types;

use FireblocksSdkLaravel\Types\Enums\TransactionOperationEnums;

class TransactionOperation
{
    private TransactionOperationEnums $operation;    //	[ BURN, CONTRACT_CALL, MINT, RAW, REDEEM_FROM_COMPOUND, SUPPLY_TO_COMPOUND, TRANSFER, TYPED_MESSAGE ].

    public function __construct(string $operation)
    {
        $this->operation = TransactionOperationEnums::{$operation}();
    }

    /**
     * @return TransactionOperationEnums
     */
    public function getOperation(): TransactionOperationEnums
    {
        return $this->operation;
    }


}