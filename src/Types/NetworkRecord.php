<?php

namespace FireblocksSdkLaravel\Types;

use FireblocksSdkLaravel\Types\Enums\NetworkStatusEnums;

class NetworkRecord
{
    private TransferPeerPathResponse $source;            //	Source of the transaction.
    private TransferPeerPathResponse $destination;       //	Destination of the transaction.
    private string                   $txHash;            //	Blockchain hash of the transaction.
    private float                    $networkFee;        //	The fee paid to the network.
    private string                   $assetId;           //	Transaction asset.
    private float                    $netAmount;         //	The net amount of the transaction, after fee deduction.
    private NetworkStatusEnums       $status;            //	Status of the blockchain transaction.
    private string                   $type;              //	Type of the blockchain network operation.
    private string                   $destinationAddress;//	Destination address.
    private string                   $sourceAddress;     //	For account based assets only, the source address of the transaction.

    /**
     * @param array $source
     * @param array $destination
     * @param string $txHash
     * @param float $networkFee
     * @param string $assetId
     * @param float $netAmount
     * @param string $status
     * @param string $type
     * @param string $destinationAddress
     * @param string $sourceAddress
     */
    public function __construct(array $source, array $destination, string $txHash, float $networkFee, string $assetId, float $netAmount, string $status, string $type, string $destinationAddress, string $sourceAddress)
    {
        $this->source             = new TransferPeerPathResponse(...$source);
        $this->destination        = new TransferPeerPathResponse(...$destination);
        $this->txHash             = $txHash;
        $this->networkFee         = $networkFee;
        $this->assetId            = $assetId;
        $this->netAmount          = $netAmount;
        $this->status             = NetworkStatusEnums::$status();
        $this->type               = $type;
        $this->destinationAddress = $destinationAddress;
        $this->sourceAddress      = $sourceAddress;
    }

    /**
     * @return TransferPeerPathResponse
     */
    public function getSource(): TransferPeerPathResponse
    {
        return $this->source;
    }

    /**
     * @return TransferPeerPathResponse
     */
    public function getDestination(): TransferPeerPathResponse
    {
        return $this->destination;
    }

    /**
     * @return string
     */
    public function getTxHash(): string
    {
        return $this->txHash;
    }

    /**
     * @return float
     */
    public function getNetworkFee(): float
    {
        return $this->networkFee;
    }

    /**
     * @return string
     */
    public function getAssetId(): string
    {
        return $this->assetId;
    }

    /**
     * @return float
     */
    public function getNetAmount(): float
    {
        return $this->netAmount;
    }

    /**
     * @return NetworkStatusEnums
     */
    public function getStatus(): NetworkStatusEnums
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getDestinationAddress(): string
    {
        return $this->destinationAddress;
    }

    /**
     * @return string
     */
    public function getSourceAddress(): string
    {
        return $this->sourceAddress;
    }

}