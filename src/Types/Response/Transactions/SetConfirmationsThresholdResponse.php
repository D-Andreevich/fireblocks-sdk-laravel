<?php

namespace FireblocksSdkLaravel\Types\Response\Transactions;

class SetConfirmationsThresholdResponse
{
    private bool $success;	//	yes or no success value.
    /**
     * @var string[]
     */
    private array $transactions;	// array of strings	txIds of the transactions.

    /**
     * @param bool $success
     * @param string[] $transactions
     */
    public function __construct(bool $success, array $transactions)
    {
        $this->success = $success;
        $this->transactions = $transactions;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return string[]
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

}