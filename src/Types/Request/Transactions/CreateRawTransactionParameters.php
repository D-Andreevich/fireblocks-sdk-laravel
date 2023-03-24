<?php

namespace FireblocksSdkLaravel\Types\Request\Transactions;

use FireblocksSdkLaravel\Types\Enums\TransactionOperationEnums;
use FireblocksSdkLaravel\Types\RawMessage;
use FireblocksSdkLaravel\Types\Request\Base\ToArray;
use FireblocksSdkLaravel\Types\Request\Base\ToArrayAccess;
use FireblocksSdkLaravel\Types\TransferPeerPath;

class CreateRawTransactionParameters implements ToArrayAccess
{
    use ToArray;

    private ?string $assetId;    //The ID of the asset
    private ?TransferPeerPath $source;    //The source account of the transaction.
    private ?string $note;    //[optional] Note to be added to the transaction history.
    private TransactionOperationEnums $operation;    //[optional] Transaction operation type, the default is "TRANSFER".
    private RawMessage $rawMessageData; //For raw signing, pass rawMessageData field.

    /**
     * @param RawMessage $rawMessageData
     * @param string|null $assetId
     * @param TransferPeerPath|null $source
     * @param string|null $note
     */
    public function __construct(RawMessage $rawMessageData, ?string $assetId = null, ?TransferPeerPath $source = null, ?string $note = null)
    {
        $this->rawMessageData = $rawMessageData;
        $this->assetId = $assetId;
        $this->source = $source;
        $this->note = $note;
        $this->operation = TransactionOperationEnums::_RAW();
    }

    /**
     * @return string|null
     */
    public function getAssetId(): ?string
    {
        return $this->assetId;
    }

    /**
     * @param string|null $assetId
     * @return CreateRawTransactionParameters
     */
    public function setAssetId(?string $assetId): CreateRawTransactionParameters
    {
        $this->assetId = $assetId;
        return $this;
    }

    /**
     * @return TransferPeerPath|null
     */
    public function getSource(): ?TransferPeerPath
    {
        return $this->source;
    }

    /**
     * @param TransferPeerPath|null $source
     * @return CreateRawTransactionParameters
     */
    public function setSource(?TransferPeerPath $source): CreateRawTransactionParameters
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string|null $note
     * @return CreateRawTransactionParameters
     */
    public function setNote(?string $note): CreateRawTransactionParameters
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return TransactionOperationEnums
     */
    public function getOperation(): TransactionOperationEnums
    {
        return $this->operation;
    }

    /**
     * @param TransactionOperationEnums $operation
     * @return CreateRawTransactionParameters
     */
    public function setOperation(TransactionOperationEnums $operation): CreateRawTransactionParameters
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * @return RawMessage
     */
    public function getRawMessageData(): RawMessage
    {
        return $this->rawMessageData;
    }

    /**
     * @param RawMessage $rawMessageData
     * @return CreateRawTransactionParameters
     */
    public function setRawMessageData(RawMessage $rawMessageData): CreateRawTransactionParameters
    {
        $this->rawMessageData = $rawMessageData;
        return $this;
    }

}