<?php

namespace FireblocksSdkLaravel\Types\Request\Transactions;

use FireblocksSdkLaravel\Types\DestinationTransferPeerPath;
use FireblocksSdkLaravel\Types\Enums\FeeLevelEnums;
use FireblocksSdkLaravel\Types\Enums\TransactionOperationEnums;
use FireblocksSdkLaravel\Types\Request\Base\ToArray;
use FireblocksSdkLaravel\Types\Request\Base\ToArrayAccess;
use FireblocksSdkLaravel\Types\TransactionOperation;
use FireblocksSdkLaravel\Types\TransferPeerPath;

class CreateTransactionParameters implements ToArrayAccess
{
    use ToArray;

    private string $assetId;    //The ID of the asset
    private TransferPeerPath $source;    //The source account of the transaction.
    private ?DestinationTransferPeerPath $destination;    //The destination of the transaction.
    private ?TransactionRequestDestinationList $destinations;    //array of TransactionRequestDestination	For UTXO based assets, you can send a single transaction to multiple destinations which should be specified using this field.
    private ?string $amount;    //string	The requested amount to transfer.
    private bool $treatAsGrossAmount = False;    //False by default, if set to true the network fee will be deducted from the requested amount.
    private ?string $fee;    //string	[optional] For UTXO assets, the fee per bytes in the asset's smallest unit (Satoshi, Latoshi, etc.). For XRP, the fee for the transaction.
    private ?string $gasPrice;    //string	[optional] For ETH-based assets only this will be used instead of the fee property, value is in Gwei.
    private ?string $gasLimit;    //string	[optional] For ETH-based assets only.
    private ?string $networkFee;    //string	[optional] The transaction blockchain fee (For Ethereum, you can't pass gasPrice, gasLimit and networkFee all together).
    private ?string $priorityFee;    //string	[optional] The priority fee of Ethereum transaction according to EIP-1559.
    private ?FeeLevelEnums $feeLevel;    //[optional] LOW / MEDIUM / HIGH - Defines the blockchain fee level which will be payed for the transaction. Only for Ethereum and UTXO blockchains.
    private ?string $maxFee;    //string	[optional] The maximum fee (gas price or fee per byte) that should be payed for the transaction. In case the current value of the requested fee level is higher than this requested maximum fee.
    private ?bool $failOnLowFee;    //[optional] False by default, if set to true and the current MEDIUM fee level is higher than the one specified in the transaction, the transction will fail to avoid getting stuck with 0 confirmations.
    private ?bool $forceSweep;    //For "DOT" transactions only, "false" by default, if set to "true" Fireblocks will allow emptying the DOT wallet.
    private ?string $note;    //[optional] Note to be added to the transaction history.
    private ?bool $autoStaking;    //[optional] Deprecated.
    private ?string $networkStaking;    //[optional] Deprecated.
    private ?string $cpuStaking;    //[optional] Deprecated.
    private ?TransactionOperation $operation;    //[optional] Transaction operation type, the default is "TRANSFER".
    private ?string $customerRefId;    //[optional] The ID for AML providers to associate the owner of funds with transactions.
    private ?string $replaceTxByHash;    //[optional] For Ethereum blockchain transactions, the hash of the stuck transaction to be replaced (RBF).
    private ?string $externalTxId;    //[optional] Unique transaction ID provided by the user. Future transactions with same ID will be rejected.
    private ?array $extraParameters;    //object	[optional] Use for protocol / operation specific parameters.
    //For raw signing, pass rawMessageData field.
    //For contract calls, pass contractCallData (See here for more details on Smart Contract API and contract calls).
    //For UTXO based blockchains inputs selectios pass inputsSelection following this structure. The inputs can be retrieved from Retrieve Unspent Inputs.
    /**
     * @param string $assetId
     * @param TransferPeerPath $source
     * @param DestinationTransferPeerPath|null $destination
     * @param TransactionRequestDestinationList|null $destinations
     * @param string|null $amount
     * @param bool $treatAsGrossAmount
     * @param string|null $fee
     * @param string|null $gasPrice
     * @param string|null $gasLimit
     * @param string|null $networkFee
     * @param string|null $priorityFee
     * @param FeeLevelEnums|null $feeLevel
     * @param string|null $maxFee
     * @param bool|null $failOnLowFee
     * @param bool|null $forceSweep
     * @param string|null $note
     * @param bool|null $autoStaking
     * @param string|null $networkStaking
     * @param string|null $cpuStaking
     * @param TransactionOperation|null $operation
     * @param string|null $customerRefId
     * @param string|null $replaceTxByHash
     * @param string|null $externalTxId
     * @param array|null $extraParameters
     */
    public function __construct(string $assetId, TransferPeerPath $source, DestinationTransferPeerPath $destination = null, TransactionRequestDestinationList $destinations = null, string $amount = null, bool $treatAsGrossAmount = false, ?string $fee = null, ?string $gasPrice = null, ?string $gasLimit = null, ?string $networkFee = null, ?string $priorityFee = null, ?FeeLevelEnums $feeLevel = null, ?string $maxFee = null, ?bool $failOnLowFee = null, ?bool $forceSweep = null, ?string $note = null, ?bool $autoStaking = null, ?string $networkStaking = null, ?string $cpuStaking = null, ?TransactionOperation $operation = null, ?string $customerRefId = null, ?string $replaceTxByHash = null, ?string $externalTxId = null, ?array $extraParameters = [])
    {
        $this->setAssetId($assetId);
        $this->setSource($source);
        if ($destination) $this->setDestination($destination);
        if ($destinations) $this->setDestinations($destinations);
        if ($amount) $this->setAmount($amount);
        if ($treatAsGrossAmount) $this->setTreatAsGrossAmount($treatAsGrossAmount);
        if ($fee) $this->setFee($fee);
        if ($gasPrice) $this->setGasPrice($gasPrice);
        if ($gasLimit) $this->setGasLimit($gasLimit);
        if ($networkFee) $this->setNetworkFee($networkFee);
        if ($priorityFee) $this->setPriorityFee($priorityFee);
        if ($feeLevel) $this->setFeeLevel($feeLevel);
        if ($maxFee) $this->setMaxFee($maxFee);
        if ($failOnLowFee) $this->setFailOnLowFee($failOnLowFee);
        if ($forceSweep) $this->setForceSweep($forceSweep);
        if ($note) $this->setNote($note);
        if ($autoStaking) $this->setAutoStaking($autoStaking);
        if ($networkStaking) $this->setNetworkStaking($networkStaking);
        if ($cpuStaking) $this->setCpuStaking($cpuStaking);
        if ($operation) $this->setOperation($operation);
        if ($customerRefId) $this->setCustomerRefId($customerRefId);
        if ($replaceTxByHash) $this->setReplaceTxByHash($replaceTxByHash);
        if ($externalTxId) $this->setExternalTxId($externalTxId);
        if ($extraParameters) $this->setExtraParameters($extraParameters);
    }

    /**
     * @return string
     */
    public function getAssetId(): string
    {
        return $this->assetId;
    }

    /**
     * @param string $assetId
     * @return CreateTransactionParameters
     */
    public function setAssetId(string $assetId): CreateTransactionParameters
    {
        $this->assetId = $assetId;
        return $this;
    }

    /**
     * @return TransferPeerPath
     */
    public function getSource(): TransferPeerPath
    {
        return $this->source;
    }

    /**
     * @param TransferPeerPath $source
     * @return CreateTransactionParameters
     */
    public function setSource(TransferPeerPath $source): CreateTransactionParameters
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return DestinationTransferPeerPath|null
     */
    public function getDestination(): ?DestinationTransferPeerPath
    {
        return $this->destination;
    }

    /**
     * @param DestinationTransferPeerPath|null $destination
     * @return CreateTransactionParameters
     */
    public function setDestination(?DestinationTransferPeerPath $destination): CreateTransactionParameters
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @return TransactionRequestDestinationList|null
     */
    public function getDestinations(): ?TransactionRequestDestinationList
    {
        return $this->destinations;
    }

    /**
     * @param TransactionRequestDestinationList|null $destinations
     * @return CreateTransactionParameters
     */
    public function setDestinations(?TransactionRequestDestinationList $destinations): CreateTransactionParameters
    {
        $this->destinations = $destinations;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAmount(): ?string
    {
        return $this->amount;
    }

    /**
     * @param string|null $amount
     * @return CreateTransactionParameters
     */
    public function setAmount(?string $amount): CreateTransactionParameters
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTreatAsGrossAmount(): bool
    {
        return $this->treatAsGrossAmount;
    }

    /**
     * @param bool $treatAsGrossAmount
     * @return CreateTransactionParameters
     */
    public function setTreatAsGrossAmount(bool $treatAsGrossAmount): CreateTransactionParameters
    {
        $this->treatAsGrossAmount = $treatAsGrossAmount;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFee(): ?string
    {
        return $this->fee;
    }

    /**
     * @param string|null $fee
     * @return CreateTransactionParameters
     */
    public function setFee(?string $fee): CreateTransactionParameters
    {
        $this->fee = $fee;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGasPrice(): ?string
    {
        return $this->gasPrice;
    }

    /**
     * @param string|null $gasPrice
     * @return CreateTransactionParameters
     */
    public function setGasPrice(?string $gasPrice): CreateTransactionParameters
    {
        $this->gasPrice = $gasPrice;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGasLimit(): ?string
    {
        return $this->gasLimit;
    }

    /**
     * @param string|null $gasLimit
     * @return CreateTransactionParameters
     */
    public function setGasLimit(?string $gasLimit): CreateTransactionParameters
    {
        $this->gasLimit = $gasLimit;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNetworkFee(): ?string
    {
        return $this->networkFee;
    }

    /**
     * @param string|null $networkFee
     * @return CreateTransactionParameters
     */
    public function setNetworkFee(?string $networkFee): CreateTransactionParameters
    {
        $this->networkFee = $networkFee;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPriorityFee(): ?string
    {
        return $this->priorityFee;
    }

    /**
     * @param string|null $priorityFee
     * @return CreateTransactionParameters
     */
    public function setPriorityFee(?string $priorityFee): CreateTransactionParameters
    {
        $this->priorityFee = $priorityFee;
        return $this;
    }

    /**
     * @return FeeLevelEnums|null
     */
    public function getFeeLevel(): ?FeeLevelEnums
    {
        return $this->feeLevel;
    }

    /**
     * @param FeeLevelEnums|null $feeLevel
     * @return CreateTransactionParameters
     */
    public function setFeeLevel(?FeeLevelEnums $feeLevel): CreateTransactionParameters
    {
        $this->feeLevel = $feeLevel;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMaxFee(): ?string
    {
        return $this->maxFee;
    }

    /**
     * @param string|null $maxFee
     * @return CreateTransactionParameters
     */
    public function setMaxFee(?string $maxFee): CreateTransactionParameters
    {
        $this->maxFee = $maxFee;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getFailOnLowFee(): ?bool
    {
        return $this->failOnLowFee;
    }

    /**
     * @param bool|null $failOnLowFee
     * @return CreateTransactionParameters
     */
    public function setFailOnLowFee(?bool $failOnLowFee): CreateTransactionParameters
    {
        $this->failOnLowFee = $failOnLowFee;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getForceSweep(): ?bool
    {
        return $this->forceSweep;
    }

    /**
     * @param bool|null $forceSweep
     * @return CreateTransactionParameters
     */
    public function setForceSweep(?bool $forceSweep): CreateTransactionParameters
    {
        $this->forceSweep = $forceSweep;
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
     * @return CreateTransactionParameters
     */
    public function setNote(?string $note): CreateTransactionParameters
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAutoStaking(): ?bool
    {
        return $this->autoStaking;
    }

    /**
     * @param bool|null $autoStaking
     * @return CreateTransactionParameters
     */
    public function setAutoStaking(?bool $autoStaking): CreateTransactionParameters
    {
        $this->autoStaking = $autoStaking;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNetworkStaking(): ?string
    {
        return $this->networkStaking;
    }

    /**
     * @param string|null $networkStaking
     * @return CreateTransactionParameters
     */
    public function setNetworkStaking(?string $networkStaking): CreateTransactionParameters
    {
        $this->networkStaking = $networkStaking;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCpuStaking(): ?string
    {
        return $this->cpuStaking;
    }

    /**
     * @param string|null $cpuStaking
     * @return CreateTransactionParameters
     */
    public function setCpuStaking(?string $cpuStaking): CreateTransactionParameters
    {
        $this->cpuStaking = $cpuStaking;
        return $this;
    }

    /**
     * @return TransactionOperation|null
     */
    public function getOperation(): ?TransactionOperation
    {
        return $this->operation;
    }

    /**
     * @param TransactionOperation|null $operation
     * @return CreateTransactionParameters
     */
    public function setOperation(?TransactionOperation $operation): CreateTransactionParameters
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomerRefId(): ?string
    {
        return $this->customerRefId;
    }

    /**
     * @param string|null $customerRefId
     * @return CreateTransactionParameters
     */
    public function setCustomerRefId(?string $customerRefId): CreateTransactionParameters
    {
        $this->customerRefId = $customerRefId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReplaceTxByHash(): ?string
    {
        return $this->replaceTxByHash;
    }

    /**
     * @param string|null $replaceTxByHash
     * @return CreateTransactionParameters
     */
    public function setReplaceTxByHash(?string $replaceTxByHash): CreateTransactionParameters
    {
        $this->replaceTxByHash = $replaceTxByHash;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExternalTxId(): ?string
    {
        return $this->externalTxId;
    }

    /**
     * @param string|null $externalTxId
     * @return CreateTransactionParameters
     */
    public function setExternalTxId(?string $externalTxId): CreateTransactionParameters
    {
        $this->externalTxId = $externalTxId;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getExtraParameters(): ?array
    {
        return $this->extraParameters;
    }

    /**
     * @param array|null $extraParameters
     * @return CreateTransactionParameters
     */
    public function setExtraParameters(?array $extraParameters): CreateTransactionParameters
    {
        $this->extraParameters = $extraParameters;
        return $this;
    }
}