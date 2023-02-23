<?php

namespace FireblocksSdkLaravel\Types;

use FireblocksSdkLaravel\Types\Enums\TransactionEnums;

class TransferTicketTerm
{
    /**
     * Defines a transfer ticket's term
     * @param string $network_connection_id The Fireblocks network connection on which this term should be fulfilled
     * @param bool $outgoing True means that the term is from the initiator of the ticket
     * @param string $asset The asset of term that was agreed on
     * @param string $amount The amount of the asset that should be transferred
     * @param string|null $note Custom note that can be added to the term
     * @param TransactionEnums|null $operation default TransactionEnums::TRANSFER()
     */
    public function __construct(string $network_connection_id, bool $outgoing, string $asset, string $amount, string $note = null, TransactionEnums $operation = null)
    {

        if (is_null($operation)) {
            $operation = TransactionEnums::TRANSFER();
        }

        $this->networkConnectionId = $network_connection_id;
        $this->outgoing            = $outgoing;
        $this->asset               = $asset;
        $this->amount              = $amount;
        if ($note)
            $this->note = $note;
        $this->operation = (string)$operation;
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
    public function getAsset(): string
    {
        return $this->asset;
    }

    /**
     * @return string
     */
    public function getNetworkConnectionId(): string
    {
        return $this->networkConnectionId;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @return bool
     */
    public function isOutgoing(): bool
    {
        return $this->outgoing;
    }


}