<?php

namespace FireblocksSdkLaravel\Types;

class AmountInfo
{
    private string $amount;              //	If the transfer is a withdrawal from an exchange, the actual amount that was requested to be transferred. Otherwise, it is the requested amount. This value will always be equal to the amount (number) parameter of TransactionDetails.
    private string $requestedAmount;     //	The amount requested by the user.
    private string $netAmount;           //	The net amount of the transaction, after fee deduction.
    private string $amountUSD;           //	The USD value of the requested amount.

    public function __construct(
        string $amount,
        string $requestedAmount,
        string $netAmount,
        string $amountUSD
    )
    {
        $this->amount          = $amount;
        $this->requestedAmount = $requestedAmount;
        $this->netAmount       = $netAmount;
        $this->amountUSD       = $amountUSD;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getRequestedAmount(): string
    {
        return $this->requestedAmount;
    }

    /**
     * @return string
     */
    public function getNetAmount(): string
    {
        return $this->netAmount;
    }

    /**
     * @return string
     */
    public function getAmountUSD(): string
    {
        return $this->amountUSD;
    }


}