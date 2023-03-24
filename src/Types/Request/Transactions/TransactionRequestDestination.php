<?php

namespace FireblocksSdkLaravel\Types\Request\Transactions;

use FireblocksSdkLaravel\Types\DestinationTransferPeerPath;

class TransactionRequestDestination
{
    private string $amount; //	The amount to be sent to this destination.
    private DestinationTransferPeerPath $destination; //	The specific destination.
}