<?php

namespace FireblocksSdkLaravel\Types\WebHook\Events\DataObjects;

use FireblocksSdkLaravel\Types\AmlScreeningResult;
use FireblocksSdkLaravel\Types\AmountInfo;
use FireblocksSdkLaravel\Types\AuthorizationInfo;
use FireblocksSdkLaravel\Types\BlockInfo;
use FireblocksSdkLaravel\Types\Enums\TransactionOperationEnums;
use FireblocksSdkLaravel\Types\Enums\TransactionStatusEnums;
use FireblocksSdkLaravel\Types\Enums\TransactionSubStatusEnums;
use FireblocksSdkLaravel\Types\FeeInfo;
use FireblocksSdkLaravel\Types\RewardsInfo;
use FireblocksSdkLaravel\Types\TransactionOperation;
use FireblocksSdkLaravel\Types\TransferPeerPathResponse;
use FireblocksSdkLaravel\Types\WebHook\Events\EventData;

class TransactionDetails implements EventData
{
    private string                    $id;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 //string	ID of the transaction.
    private string                    $assetId;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   //string	Transaction asset.
    private TransferPeerPathResponse  $source;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    //TransferPeerPathResponse	Source of the transaction.
    private TransferPeerPathResponse  $destination;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               //TransferPeerPathResponse	Fireblocks supports multiple destinations for UTXO-based blockchains. For other blockchains, this array will always be composed of one element.
    private float                     $requestedAmount;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           //number	The amount requested by the user.
    private AmountInfo                $amountInfo;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //AmountInfo	Details of the transaction's amount in string format.
    private FeeInfo                   $feeInfo;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   //FeeInfo	Details of the transaction's fee in string format.
    private float                     $amount;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    //number	If the transfer is a withdrawal from an exchange, the actual amount that was requested to be transferred. Otherwise, the requested amount.
    private float                     $netAmount;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 //number	The net amount of the transaction, after fee deduction.
    private float                     $amountUSD;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 //number	The USD value of the requested amount.
    private float                     $serviceFee;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //number	The total fee deducted by the exchange from the actual requested amount (serviceFee = amount - netAmount).
    private bool                      $treatAsGrossAmount;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        //boolean	For outgoing transactions, if true, the network fee is deducted from the requested amount.
    private float                     $networkFee;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //number	The fee paid to the network.
    private int                       $createdAt;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 //number	Unix timestamp.
    private int                       $lastUpdated;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               //number	Unix timestamp.
    private TransactionStatusEnums    $status;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    //TransactionStatus	The current status of the transaction.
    private string                    $txHash;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    //string	Blockchain hash of the transaction.
    private ?int                      $index;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     //number	[optional] For UTXO based assets this is the vOut, for Ethereum based, this is the index of the event of the contract call.
    private TransactionSubStatusEnums $subStatus;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 //TransactionSubStatus	More detailed status of the transaction.
    private string                    $sourceAddress;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             //string	For account based assets only, the source address of the transaction. (Note: This parameter will be empty for transactions that are not: CONFIRMING, COMPLETED, or REJECTED/FAILED after passing CONFIRMING status.)
    private string                    $destinationAddress;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        //string	Address where the asset were transferred.
    private string                    $destinationAddressDescription;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             //string	Description of the address.
    private string                    $destinationTag;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            //string	Destination tag for XRP, used as memo for EOS/XLM, or Bank Transfer Description for the fiat providers: Signet (by Signature), SEN (by Silvergate), or BLINC (by BCB Group).
    private array                     $signedBy;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  //Array of strings	Signers of the transaction.
    private string                    $createdBy;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 //string	Initiator of the transaction.
    private string                    $rejectedBy;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //string	User ID of the user that rejected the transaction (in case it was rejected).
    private string                    $addressType;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               //string	[ ONE_TIME, WHITELISTED ].
    private string                    $note;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      //string	Custom note of the transaction.
    private string                    $exchangeTxId;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              //string	If the transaction originated from an exchange, this is the exchange tx ID.
    private string                    $feeCurrency;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               //string	The asset which was taken to pay the fee (ETH for ERC-20 tokens, BTC for Tether Omni).
    private TransactionOperation      $operation;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 //TransactionOperation	Default operation is "TRANSFER".
    private AmlScreeningResult        $amlScreeningResult;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        //AmlScreeningResult	The result of the AML screening.
    private string                    $customerRefId;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             //string	The ID for AML providers to associate the owner of funds with transactions.
    private int                       $numOfConfirmations;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        //number	The number of confirmations of the transaction. The number will increase until the transaction will be considered completed according to the confirmation policy.
    private array                     $networkRecords;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            //Array of NetworkRecord objects	Transaction on the Fireblocks platform can aggregate several blockchain transactions, in such a case these records specify all the transactions that took place on the blockchain.
    private string                    $replacedTxHash;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            //string	In case of an RBF transaction, the hash of the dropped transaction.
    private string                    $externalTxId;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              //string	Unique transaction ID provided by the user.
    private array                     $destinations;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              //Array of DestinationsResponse	For UTXO based assets, all outputs specified here.
    private BlockInfo                 $blockInfo;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 //BlockInfo	The information of the block that this transaction was mined in, the blocks's hash and height.
    private RewardsInfo               $rewardsInfo;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               //RewardsInfo	This field is relevant only for ALGO transactions. Both srcRewrds and destRewards will appear only for Vault to Vault transactions, otherwise you will receive only the Fireblocks' side of the transaction.
    private AuthorizationInfo         $authorizationInfo;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         //AuthorizationInfo	The information about your Transaction Authorization Policy (TAP). For more information about the TAP, refer to this section in the Help Center.
    private array                     $signedMessages;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            //Array of SignedMessage objects	A list of signed messages returned for raw signing.
    private array                     $extraParameters;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           //JSON object	Protocol / operation specific parameters.
    private array                     $systemMessages;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            //Array of SystemMessageInfo objects	A response from Fireblocks that communicates a message about the health of the process being performed. If this object is returned with data, you should expect potential delays or incomplete transaction statuses.


    public function __construct(
        string $id,
        string $assetId,
        array  $source,
        array  $destination,
        float  $requestedAmount,
        array  $amountInfo,
        array  $feeInfo,
        float  $amount,
        float  $netAmount,
        float  $amountUSD,
        float  $serviceFee,
        bool   $treatAsGrossAmount,
        float  $networkFee,
        int    $createdAt,
        int    $lastUpdated,
        string $status,
        string $txHash,
        int    $index = null,
        string $subStatus,
        string $sourceAddress,
        string $destinationAddress,
        string $destinationAddressDescription,
        string $destinationTag,
        array  $signedBy,
        string $createdBy,
        string $rejectedBy,
        string $addressType,
        string $note,
        string $exchangeTxId,
        string $feeCurrency,
        string $operation = TransactionOperationEnums::_TRANSFER,
        array  $amlScreeningResult,
        string $customerRefId,
        int    $numOfConfirmations,
        array  $networkRecords,
        string $replacedTxHash,
        string $externalTxId,
        array  $destinations,
        array  $blockInfo,
        array  $rewardsInfo,
        array  $authorizationInfo,
        array  $signedMessages,
        string $extraParameters = "",
        array  $systemMessages
    )
    {
        $this->id                            = $id;
        $this->assetId                       = $assetId;
        $this->source                        = new TransferPeerPathResponse(...$source);
        $this->destination                   = new TransferPeerPathResponse(...$destination);
        $this->requestedAmount               = $requestedAmount;
        $this->amountInfo                    = new AmountInfo(...$amountInfo);
        $this->feeInfo                       = new FeeInfo(...$feeInfo);
        $this->amount                        = $amount;
        $this->netAmount                     = $netAmount;
        $this->amountUSD                     = $amountUSD;
        $this->serviceFee                    = $serviceFee;
        $this->treatAsGrossAmount            = $treatAsGrossAmount;
        $this->networkFee                    = $networkFee;
        $this->createdAt                     = $createdAt;
        $this->lastUpdated                   = $lastUpdated;
        $this->status                        = TransactionStatusEnums::{$status}();
        $this->txHash                        = $txHash;
        $this->index                         = $index;
        $this->subStatus                     = TransactionSubStatusEnums::{$subStatus}();
        $this->sourceAddress                 = $sourceAddress;
        $this->destinationAddress            = $destinationAddress;
        $this->destinationAddressDescription = $destinationAddressDescription;
        $this->destinationTag                = $destinationTag;
        $this->signedBy                      = $signedBy;
        $this->createdBy                     = $createdBy;
        $this->rejectedBy                    = $rejectedBy;
        $this->addressType                   = $addressType;
        $this->note                          = $note;
        $this->exchangeTxId                  = $exchangeTxId;
        $this->feeCurrency                   = $feeCurrency;
        $this->operation                     = new TransactionOperation($operation);
        $this->amlScreeningResult            = new AmlScreeningResult(...$amlScreeningResult);
        $this->customerRefId                 = $customerRefId;
        $this->numOfConfirmations            = $numOfConfirmations;
        $this->networkRecords                = $networkRecords;
        $this->replacedTxHash                = $replacedTxHash;
        $this->externalTxId                  = $externalTxId;
        $this->destinations                  = $destinations;
        $this->blockInfo                     = new BlockInfo(...$blockInfo);
        $this->rewardsInfo                   = new RewardsInfo(...$rewardsInfo);
        $this->authorizationInfo             = new AuthorizationInfo(...$authorizationInfo);
        $this->signedMessages                = $signedMessages;
        $this->extraParameters               = json_decode($extraParameters);
        $this->systemMessages                = $systemMessages;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAssetId(): string
    {
        return $this->assetId;
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
     * @return float
     */
    public function getRequestedAmount(): float
    {
        return $this->requestedAmount;
    }

    /**
     * @return AmountInfo
     */
    public function getAmountInfo(): AmountInfo
    {
        return $this->amountInfo;
    }

    /**
     * @return FeeInfo
     */
    public function getFeeInfo(): FeeInfo
    {
        return $this->feeInfo;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getNetAmount(): float
    {
        return $this->netAmount;
    }

    /**
     * @return float
     */
    public function getAmountUSD(): float
    {
        return $this->amountUSD;
    }

    /**
     * @return float
     */
    public function getServiceFee(): float
    {
        return $this->serviceFee;
    }

    /**
     * @return bool
     */
    public function isTreatAsGrossAmount(): bool
    {
        return $this->treatAsGrossAmount;
    }

    /**
     * @return float
     */
    public function getNetworkFee(): float
    {
        return $this->networkFee;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getLastUpdated(): int
    {
        return $this->lastUpdated;
    }

    /**
     * @return TransactionStatusEnums
     */
    public function getStatus(): TransactionStatusEnums
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getTxHash(): string
    {
        return $this->txHash;
    }

    /**
     * @return int|null
     */
    public function getIndex(): ?int
    {
        return $this->index;
    }

    /**
     * @return TransactionSubStatusEnums
     */
    public function getSubStatus(): TransactionSubStatusEnums
    {
        return $this->subStatus;
    }

    /**
     * @return string
     */
    public function getSourceAddress(): string
    {
        return $this->sourceAddress;
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
    public function getDestinationAddressDescription(): string
    {
        return $this->destinationAddressDescription;
    }

    /**
     * @return string
     */
    public function getDestinationTag(): string
    {
        return $this->destinationTag;
    }

    /**
     * @return array
     */
    public function getSignedBy(): array
    {
        return $this->signedBy;
    }

    /**
     * @return string
     */
    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }

    /**
     * @return string
     */
    public function getRejectedBy(): string
    {
        return $this->rejectedBy;
    }

    /**
     * @return string
     */
    public function getAddressType(): string
    {
        return $this->addressType;
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
    public function getExchangeTxId(): string
    {
        return $this->exchangeTxId;
    }

    /**
     * @return string
     */
    public function getFeeCurrency(): string
    {
        return $this->feeCurrency;
    }

    /**
     * @return TransactionOperation
     */
    public function getOperation(): TransactionOperation
    {
        return $this->operation;
    }

    /**
     * @return AmlScreeningResult
     */
    public function getAmlScreeningResult(): AmlScreeningResult
    {
        return $this->amlScreeningResult;
    }

    /**
     * @return string
     */
    public function getCustomerRefId(): string
    {
        return $this->customerRefId;
    }

    /**
     * @return int
     */
    public function getNumOfConfirmations(): int
    {
        return $this->numOfConfirmations;
    }

    /**
     * @return array
     */
    public function getNetworkRecords(): array
    {
        return $this->networkRecords;
    }

    /**
     * @return string
     */
    public function getReplacedTxHash(): string
    {
        return $this->replacedTxHash;
    }

    /**
     * @return string
     */
    public function getExternalTxId(): string
    {
        return $this->externalTxId;
    }

    /**
     * @return array
     */
    public function getDestinations(): array
    {
        return $this->destinations;
    }

    /**
     * @return BlockInfo
     */
    public function getBlockInfo(): BlockInfo
    {
        return $this->blockInfo;
    }

    /**
     * @return RewardsInfo
     */
    public function getRewardsInfo(): RewardsInfo
    {
        return $this->rewardsInfo;
    }

    /**
     * @return AuthorizationInfo
     */
    public function getAuthorizationInfo(): AuthorizationInfo
    {
        return $this->authorizationInfo;
    }

    /**
     * @return array
     */
    public function getSignedMessages(): array
    {
        return $this->signedMessages;
    }

    /**
     * @return array|mixed
     */
    public function getExtraParameters()
    {
        return $this->extraParameters;
    }

    /**
     * @return array
     */
    public function getSystemMessages(): array
    {
        return $this->systemMessages;
    }


}