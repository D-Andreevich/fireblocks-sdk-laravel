<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;

class UnspentInputsData
{
    private Input $input; //	An object containing the txHash and index of this input.
    private string $address; //	The destination address of this input.
    private string $amount; //	The amount of this input.
    private int $confirmations; //	Number of confirmations for the transaction of this input.
    private string $status; //	The status is based on the status of the transaction.

    /**
     * @param array $input
     * @param string $address
     * @param string $amount
     * @param int $confirmations
     * @param string $status
     */
    public function __construct(array $input, string $address, string $amount, int $confirmations, string $status)
    {
        $this->input = new Input(...$input);
        $this->address = $address;
        $this->amount = $amount;
        $this->confirmations = $confirmations;
        $this->status = $status;
    }

    /**
     * @return Input
     */
    public function getInput(): Input
    {
        return $this->input;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getConfirmations(): int
    {
        return $this->confirmations;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}