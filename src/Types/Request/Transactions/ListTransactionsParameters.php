<?php

namespace FireblocksSdkLaravel\Types\Request\Transactions;

use FireblocksSdkLaravel\Types\Enums\PeerEnums;
use FireblocksSdkLaravel\Types\Enums\TransactionStatusEnums;
use FireblocksSdkLaravel\Types\Request\Base\ToArray;
use FireblocksSdkLaravel\Types\Request\Base\ToArrayAccess;

class ListTransactionsParameters implements ToArrayAccess
{
    use ToArray;

    private ?int $before; //	[optional] Unix timestamp in milliseconds. Returns only transactions created before the specified date.
    private ?int $after; //	[optional] Unix timestamp in milliseconds. Returns only transactions created after the specified date.
    private ?TransactionStatusEnums $status; //	[optional] You can filter by one of the statuses.
    private ?string $orderBy; //	[optional] The field to order the results by. Available values : createdAt (default), lastUpdated.
    private ?PeerEnums $sourceType; //	[optional] The source type of the transaction. Available values: VAULT_ACCOUNT, EXCHANGE_ACCOUNT, INTERNAL_WALLET, EXTERNAL_WALLET, FIAT_ACCOUNT, NETWORK_CONNECTION, COMPOUND, UNKNOWN, GAS_STATION, OEC_PARTNER.
    private ?string $sourceId; //	[optional] The source ID of the transaction.
    private ?PeerEnums $destType; //	[optional] The destination type of the transaction. Available values: VAULT_ACCOUNT, EXCHANGE_ACCOUNT, INTERNAL_WALLET, EXTERNAL_WALLET, ONE_TIME_ADDRESS, FIAT_ACCOUNT, NETWORK_CONNECTION, COMPOUND.
    private ?string $destId; //	[optional] The destination ID of the transaction.
    private ?string $assets; //	[optional] A list of assets to filter by, separated by commas.
    private ?string $txHash; //	[optional] Returns only results with a specified txHash.
    private ?int $limit; //	[optional] Limits the number of returned transactions. If not provided, a default of 200 will be returned. The maximum allowed limit is 500.
    private ?string $sort; //	[optional] Possible values are ASC or DESC, DESC is the default behavior for getting transaction from latests to the oldest.

    /**
     * @param int|null $before
     * @param int|null $after
     * @param TransactionStatusEnums|null $status
     * @param int|null $limit
     * @param string|null $txHash
     * @param string|null $assets
     * @param PeerEnums|null $sourceType
     * @param string|null $sourceId
     * @param PeerEnums|null $destType
     * @param string|null $destId
     * @param string|null $orderBy
     * @param string|null $sort
     */
    public function __construct(int    $before = null, int $after = null, TransactionStatusEnums $status = null, int $limit = null, string $txHash = null,
                                string $assets = null, PeerEnums $sourceType = null, string $sourceId = null, PeerEnums $destType = null, string $destId = null,
                                string $orderBy = null, string $sort = null)
    {
        $this->setBefore($before);
        $this->setAfter($after);
        $this->setStatus($status);
        $this->setOrderby($orderBy);
        $this->setSourcetype($sourceType);
        $this->setSourceid($sourceId);
        $this->setDesttype($destType);
        $this->setDestid($destId);
        $this->setAssets($assets);
        $this->setTxhash($txHash);
        $this->setLimit($limit);
        $this->setSort($sort);
    }

    /**
     * @return int|null
     */
    public function getBefore(): ?int
    {
        return $this->before;
    }

    /**
     * @param int|null $before
     * @return ListTransactionsParameters
     */
    public function setBefore(?int $before): ListTransactionsParameters
    {
        $this->before = $before;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAfter(): ?int
    {
        return $this->after;
    }

    /**
     * @param int|null $after
     * @return ListTransactionsParameters
     */
    public function setAfter(?int $after): ListTransactionsParameters
    {
        $this->after = $after;
        return $this;
    }

    /**
     * @return TransactionStatusEnums|null
     */
    public function getStatus(): ?TransactionStatusEnums
    {
        return $this->status;
    }

    /**
     * @param TransactionStatusEnums|null $status
     * @return ListTransactionsParameters
     */
    public function setStatus(?TransactionStatusEnums $status): ListTransactionsParameters
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    /**
     * @param string|null $orderBy
     * @return ListTransactionsParameters
     */
    public function setOrderBy(?string $orderBy): ListTransactionsParameters
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @return PeerEnums|null
     */
    public function getSourceType(): ?PeerEnums
    {
        return $this->sourceType;
    }

    /**
     * @param PeerEnums|null $sourceType
     * @return ListTransactionsParameters
     */
    public function setSourceType(?PeerEnums $sourceType): ListTransactionsParameters
    {
        $this->sourceType = $sourceType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSourceId(): ?string
    {
        return $this->sourceId;
    }

    /**
     * @param string|null $sourceId
     * @return ListTransactionsParameters
     */
    public function setSourceId(?string $sourceId): ListTransactionsParameters
    {
        $this->sourceId = $sourceId;
        return $this;
    }

    /**
     * @return PeerEnums|null
     */
    public function getDestType(): ?PeerEnums
    {
        return $this->destType;
    }

    /**
     * @param PeerEnums|null $destType
     * @return ListTransactionsParameters
     */
    public function setDestType(?PeerEnums $destType): ListTransactionsParameters
    {
        $this->destType = $destType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDestId(): ?string
    {
        return $this->destId;
    }

    /**
     * @param string|null $destId
     * @return ListTransactionsParameters
     */
    public function setDestId(?string $destId): ListTransactionsParameters
    {
        $this->destId = $destId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAssets(): ?string
    {
        return $this->assets;
    }

    /**
     * @param string|null $assets
     * @return ListTransactionsParameters
     */
    public function setAssets(?string $assets): ListTransactionsParameters
    {
        $this->assets = $assets;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTxHash(): ?string
    {
        return $this->txHash;
    }

    /**
     * @param string|null $txHash
     * @return ListTransactionsParameters
     */
    public function setTxHash(?string $txHash): ListTransactionsParameters
    {
        $this->txHash = $txHash;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @param int|null $limit
     * @return ListTransactionsParameters
     */
    public function setLimit(?int $limit): ListTransactionsParameters
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSort(): ?string
    {
        return $this->sort;
    }

    /**
     * @param string|null $sort
     * @return ListTransactionsParameters
     */
    public function setSort(?string $sort): ListTransactionsParameters
    {
        $this->sort = $sort;
        return $this;
    }

}