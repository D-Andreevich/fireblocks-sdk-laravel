<?php

namespace FireblocksSdkLaravel\Types\Request\Transactions;

use FireblocksSdkLaravel\Types\DestinationTransferPeerPath;
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
    private DestinationTransferPeerPath $destination;    //The destination of the transaction.
    private TransactionRequestDestinationList $destinations;    //array of TransactionRequestDestination	For UTXO based assets, you can send a single transaction to multiple destinations which should be specified using this field.
    private string $amount;    //string	The requested amount to transfer.
    private bool $treatAsGrossAmount = False;    //False by default, if set to true the network fee will be deducted from the requested amount.
    private ?string $fee;    //string	[optional] For UTXO assets, the fee per bytes in the asset's smallest unit (Satoshi, Latoshi, etc.). For XRP, the fee for the transaction.
    private ?string $gasPrice;    //string	[optional] For ETH-based assets only this will be used instead of the fee property, value is in Gwei.
    private ?string $gasLimit;    //string	[optional] For ETH-based assets only.
    private ?string $networkFee;    //string	[optional] The transaction blockchain fee (For Ethereum, you can't pass gasPrice, gasLimit and networkFee all together).
    private ?string $priorityFee;    //string	[optional] The priority fee of Ethereum transaction according to EIP-1559.
    private ?string $feeLevel;    //[optional] LOW / MEDIUM / HIGH - Defines the blockchain fee level which will be payed for the transaction. Only for Ethereum and UTXO blockchains.
    private ?string $maxFee;    //string	[optional] The maximum fee (gas price or fee per byte) that should be payed for the transaction. In case the current value of the requested fee level is higher than this requested maximum fee.
    private ?bool $failOnLowFee;    //[optional] False by default, if set to true and the current MEDIUM fee level is higher than the one specified in the transaction, the transction will fail to avoid getting stuck with 0 confirmations.
    private ?bool $forceSweep;    //For "DOT" transactions only, "false" by default, if set to "true" Fireblocks will allow emptying the DOT wallet.
    private ?string $note;    //[optional] Note to be added to the transaction history.
    private ?bool $autoStaking;    //[optional] Deprecated.
    private ?string $networkStaking;    //[optional] Deprecated.
    private ?string $cpuStaking;    //[optional] Deprecated.
    private ?TransactionOperationEnums $operation;    //[optional] Transaction operation type, the default is "TRANSFER".
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
     * @param DestinationTransferPeerPath $destination
     * @param TransactionRequestDestinationList $destinations
     * @param string $amount
     * @param bool $treatAsGrossAmount
     * @param string|null $fee
     * @param string|null $gasPrice
     * @param string|null $gasLimit
     * @param string|null $networkFee
     * @param string|null $priorityFee
     * @param string|null $feeLevel
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
    public function __construct(string $assetId, TransferPeerPath $source, DestinationTransferPeerPath $destination, TransactionRequestDestinationList $destinations, string $amount, bool $treatAsGrossAmount, ?string $fee = null, ?string $gasPrice = null, ?string $gasLimit = null, ?string $networkFee = null, ?string $priorityFee = null, ?string $feeLevel = null, ?string $maxFee = null, ?bool $failOnLowFee = null, ?bool $forceSweep = null, ?string $note = null, ?bool $autoStaking = null, ?string $networkStaking = null, ?string $cpuStaking = null, ?TransactionOperation $operation = null, ?string $customerRefId = null, ?string $replaceTxByHash = null, ?string $externalTxId = null, ?array $extraParameters = [])
    {
        $this->setAssetId($assetId);
        $this->setSource($source);
        $this->setDestination($destination);
        $this->setDestinations($destinations);
        $this->setAmount($amount);
        $this->setTreatAsGrossAmount($treatAsGrossAmount);
        $this->setFee($fee);
        $this->setGasPrice($gasPrice);
        $this->setGasLimit($gasLimit);
        $this->setNetworkFee($networkFee);
        $this->setPriorityFee($priorityFee);
        $this->setFeeLevel($feeLevel);
        $this->setMaxFee($maxFee);
        $this->setFailOnLowFee($failOnLowFee);
        $this->setForceSweep($forceSweep);
        $this->setNote($note);
        $this->setAutoStaking($autoStaking);
        $this->setNetworkStaking($networkStaking);
        $this->setCpuStaking($cpuStaking);
        $this->setOperation($operation);
        $this->setCustomerRefId($customerRefId);
        $this->setReplaceTxByHash($replaceTxByHash);
        $this->setExternalTxId($externalTxId);
        $this->setExtraParameters($extraParameters);
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
     * @param TransferPeerPath $source
     * @return CreateTransactionParameters
     */
    public function setSource(TransferPeerPath $source): CreateTransactionParameters
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @param DestinationTransferPeerPath $destination
     * @return CreateTransactionParameters
     */
    public function setDestination(DestinationTransferPeerPath $destination): CreateTransactionParameters
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @param TransactionRequestDestinationList $destinations
     * @return CreateTransactionParameters
     */
    public function setDestinations(TransactionRequestDestinationList $destinations): CreateTransactionParameters
    {
        $this->destinations = $destinations;
        return $this;
    }

    /**
     * @param string $amount
     * @return CreateTransactionParameters
     */
    public function setAmount(string $amount): CreateTransactionParameters
    {
        $this->amount = $amount;
        return $this;
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
     * @param string|null $fee
     * @return CreateTransactionParameters
     */
    public function setFee(?string $fee): CreateTransactionParameters
    {
        $this->fee = $fee;
        return $this;
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
     * @param string|null $gasLimit
     * @return CreateTransactionParameters
     */
    public function setGasLimit(?string $gasLimit): CreateTransactionParameters
    {
        $this->gasLimit = $gasLimit;
        return $this;
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
     * @param string|null $priorityFee
     * @return CreateTransactionParameters
     */
    public function setPriorityFee(?string $priorityFee): CreateTransactionParameters
    {
        $this->priorityFee = $priorityFee;
        return $this;
    }

    /**
     * @param string|null $feeLevel
     * @return CreateTransactionParameters
     */
    public function setFeeLevel(?string $feeLevel): CreateTransactionParameters
    {
        $this->feeLevel = $feeLevel;
        return $this;
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
     * @param bool|null $failOnLowFee
     * @return CreateTransactionParameters
     */
    public function setFailOnLowFee(?bool $failOnLowFee): CreateTransactionParameters
    {
        $this->failOnLowFee = $failOnLowFee;
        return $this;
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
     * @param string|null $note
     * @return CreateTransactionParameters
     */
    public function setNote(?string $note): CreateTransactionParameters
    {
        $this->note = $note;
        return $this;
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
     * @param string|null $networkStaking
     * @return CreateTransactionParameters
     */
    public function setNetworkStaking(?string $networkStaking): CreateTransactionParameters
    {
        $this->networkStaking = $networkStaking;
        return $this;
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
     * @param TransactionOperation|null $operation
     * @return CreateTransactionParameters
     */
    public function setOperation(?TransactionOperation $operation): CreateTransactionParameters
    {
        $this->operation = $operation;
        return $this;
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
     * @param string|null $replaceTxByHash
     * @return CreateTransactionParameters
     */
    public function setReplaceTxByHash(?string $replaceTxByHash): CreateTransactionParameters
    {
        $this->replaceTxByHash = $replaceTxByHash;
        return $this;
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
     * @param array|null $extraParameters
     * @return CreateTransactionParameters
     */
    public function setExtraParameters(?array $extraParameters): CreateTransactionParameters
    {
        $this->extraParameters = $extraParameters;
        return $this;
    }

    /**
     * @return string
     */
    public function getAssetId(): string
    {
        return $this->assetId;
    }

    /**
     * @return TransferPeerPath
     */
    public function getSource(): TransferPeerPath
    {
        return $this->source;
    }

    /**
     * @return DestinationTransferPeerPath
     */
    public function getDestination(): DestinationTransferPeerPath
    {
        return $this->destination;
    }

    /**
     * @return TransactionRequestDestinationList
     */
    public function getDestinations(): TransactionRequestDestinationList
    {
        return $this->destinations;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return bool
     */
    public function isTreatAsGrossAmount(): bool
    {
        return $this->treatAsGrossAmount;
    }

    /**
     * @return string|null
     */
    public function getFee(): ?string
    {
        return $this->fee;
    }

    /**
     * @return string|null
     */
    public function getGasPrice(): ?string
    {
        return $this->gasPrice;
    }

    /**
     * @return string|null
     */
    public function getGasLimit(): ?string
    {
        return $this->gasLimit;
    }

    /**
     * @return string|null
     */
    public function getNetworkFee(): ?string
    {
        return $this->networkFee;
    }

    /**
     * @return string|null
     */
    public function getPriorityFee(): ?string
    {
        return $this->priorityFee;
    }

    /**
     * @return string|null
     */
    public function getFeeLevel(): ?string
    {
        return $this->feeLevel;
    }

    /**
     * @return string|null
     */
    public function getMaxFee(): ?string
    {
        return $this->maxFee;
    }

    /**
     * @return bool|null
     */
    public function getFailOnLowFee(): ?bool
    {
        return $this->failOnLowFee;
    }

    /**
     * @return bool|null
     */
    public function getForceSweep(): ?bool
    {
        return $this->forceSweep;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @return bool|null
     */
    public function getAutoStaking(): ?bool
    {
        return $this->autoStaking;
    }

    /**
     * @return string|null
     */
    public function getNetworkStaking(): ?string
    {
        return $this->networkStaking;
    }

    /**
     * @return string|null
     */
    public function getCpuStaking(): ?string
    {
        return $this->cpuStaking;
    }

    /**
     * @return TransactionOperationEnums|null
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @return string|null
     */
    public function getCustomerRefId(): ?string
    {
        return $this->customerRefId;
    }

    /**
     * @return string|null
     */
    public function getReplaceTxByHash(): ?string
    {
        return $this->replaceTxByHash;
    }

    /**
     * @return string|null
     */
    public function getExternalTxId(): ?string
    {
        return $this->externalTxId;
    }

    /**
     * @return array|null
     */
    public function getExtraParameters(): ?array
    {
        return $this->extraParameters;
    }

}