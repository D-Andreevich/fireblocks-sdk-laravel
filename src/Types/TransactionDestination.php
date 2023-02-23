<?php

namespace FireblocksSdkLaravel\Types;

class TransactionDestination
{
    /**
     * @param double $amount
     * @param DestinationTransferPeerPath $destination
     */
    public function __construct(float $amount, DestinationTransferPeerPath $destination)
    {
        $this->amount = (string)$amount;
        $this->destination = get_object_vars($destination);
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return array
     */
    public function getDestination(): array
    {
        return $this->destination;
    }


}