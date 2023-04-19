<?php

namespace FireblocksSdkLaravel\Types\Request\Transactions;

use FireblocksSdkLaravel\Types\DestinationTransferPeerPath;

class TransactionRequestDestination
{
    private string $amount; //	The amount to be sent to this destination.
    private DestinationTransferPeerPath $destination; //	The specific destination.

    /**
     * @param string $amount
     * @param array $destination
     */
    public function __construct(string $amount, array $destination)
    {
        $this->amount = $amount;
        $this->destination = new DestinationTransferPeerPath(...$destination);
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return DestinationTransferPeerPath
     */
    public function getDestination(): DestinationTransferPeerPath
    {
        return $this->destination;
    }

}