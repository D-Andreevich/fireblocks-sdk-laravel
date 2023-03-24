<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;

class Input
{
    private string $txHash; //	the hash value of the transaction.
    private string $index; //	vOut of the txHash.

    /**
     * @param string $txHash
     * @param string $index
     */
    public function __construct(string $txHash, string $index)
    {
        $this->txHash = $txHash;
        $this->index = $index;
    }

    /**
     * @return string
     */
    public function getTxHash(): string
    {
        return $this->txHash;
    }

    /**
     * @return string
     */
    public function getIndex(): string
    {
        return $this->index;
    }
}