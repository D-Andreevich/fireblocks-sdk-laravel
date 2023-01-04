<?php

namespace FireblocksSDK\Types;

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
}