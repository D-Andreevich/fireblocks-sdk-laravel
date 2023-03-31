<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;

use FireblocksSdkLaravel\Types\Request\Base\ToArray;
use FireblocksSdkLaravel\Types\Request\Base\ToArrayAccess;

class VaultAsset implements ToArrayAccess
{
    use ToArray;

    private string $id;                             //The ID of the asset.
    private string $total;                          //The total wallet balance. Values are returned according to balance decimal precision.
    private string $balance;                        //Deprecated - replaced by "total".
    private string $available;                      //Funds available for transfer. Equals the blockchain balance minus any locked amount. Values are returned according to balance decimal precision.
    private string $pending;                        //The cumulative balance of all transactions pending to be cleared. Values are returned according to balance decimal precision.
    private string $staked;                         //Staked funds, returned only for DOT. Values are returned according to balance decimal precision.
    private string $frozen;                         //Frozen by the AML policy in your workspace. Values are returned according to balance decimal precision.
    private string $lockedAmount;                   //Funds in outgoing transactions that are not yet published to the network. Values are returned according to balance decimal precision.
    private string $blockHeight;                    //The height (number) of the block of the balance.
    private ?int $maxBip44AddressIndexUsed;       //The maximum BIP44 index used in deriving addresses for this wallet.
    private ?int $maxBip44ChangeAddressIndexUsed; //The maximum BIP44 index used in deriving change addresses for this wallet.
    private ?string $totalStakedCPU;                 //[optional] Deprecated.
    private ?string $totalStakedNetwork;             //[optional] Deprecated.
    private ?string $selfStakedCPU;                  //[optional] Deprecated.
    private ?string $selfStakedNetwork;              //[optional] Deprecated.
    private ?string $pendingRefundCPU;               //[optional] Deprecated.
    private ?string $pendingRefundNetwork;           //[optional] Deprecated.
    private ?string $blockHash;                      //The hash of the block of the balance.

    public function __construct(
        string $id,
        string $total,
        string $available,
        string $pending,
        string $staked,
        string $frozen,
        string $lockedAmount,
        string $blockHeight,
        ?string $blockHash = null,
        ?int    $maxBip44AddressIndexUsed = null,
        ?int    $maxBip44ChangeAddressIndexUsed = null,
        ?string $balance = null,
        ?string $totalStakedCPU = null,
        ?string $totalStakedNetwork = null,
        ?string $selfStakedCPU = null,
        ?string $selfStakedNetwork = null,
        ?string $pendingRefundCPU = null,
        ?string $pendingRefundNetwork = null
    )
    {
        $this->id = $id;
        $this->total = $total;
        $this->balance = $balance;
        $this->available = $available;
        $this->pending = $pending;
        $this->staked = $staked;
        $this->frozen = $frozen;
        $this->lockedAmount = $lockedAmount;
        $this->maxBip44AddressIndexUsed = $maxBip44AddressIndexUsed;
        $this->maxBip44ChangeAddressIndexUsed = $maxBip44ChangeAddressIndexUsed;
        $this->totalStakedCPU = $totalStakedCPU;
        $this->totalStakedNetwork = $totalStakedNetwork;
        $this->selfStakedCPU = $selfStakedCPU;
        $this->selfStakedNetwork = $selfStakedNetwork;
        $this->pendingRefundCPU = $pendingRefundCPU;
        $this->pendingRefundNetwork = $pendingRefundNetwork;
        $this->blockHeight = $blockHeight;
        $this->blockHash = $blockHash;
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
    public function getTotal(): string
    {
        return $this->total;
    }

    /**
     * @return string|null
     */
    public function getBalance(): ?string
    {
        return $this->balance;
    }

    /**
     * @return string
     */
    public function getAvailable(): string
    {
        return $this->available;
    }

    /**
     * @return string
     */
    public function getPending(): string
    {
        return $this->pending;
    }

    /**
     * @return string
     */
    public function getStaked(): string
    {
        return $this->staked;
    }

    /**
     * @return string
     */
    public function getFrozen(): string
    {
        return $this->frozen;
    }

    /**
     * @return string
     */
    public function getLockedAmount(): string
    {
        return $this->lockedAmount;
    }

    /**
     * @return string
     */
    public function getBlockHeight(): string
    {
        return $this->blockHeight;
    }

    /**
     * @return int|null
     */
    public function getMaxBip44AddressIndexUsed(): ?int
    {
        return $this->maxBip44AddressIndexUsed;
    }

    /**
     * @return int|null
     */
    public function getMaxBip44ChangeAddressIndexUsed(): ?int
    {
        return $this->maxBip44ChangeAddressIndexUsed;
    }

    /**
     * @return string|null
     */
    public function getTotalStakedCPU(): ?string
    {
        return $this->totalStakedCPU;
    }

    /**
     * @return string|null
     */
    public function getTotalStakedNetwork(): ?string
    {
        return $this->totalStakedNetwork;
    }

    /**
     * @return string|null
     */
    public function getSelfStakedCPU(): ?string
    {
        return $this->selfStakedCPU;
    }

    /**
     * @return string|null
     */
    public function getSelfStakedNetwork(): ?string
    {
        return $this->selfStakedNetwork;
    }

    /**
     * @return string|null
     */
    public function getPendingRefundCPU(): ?string
    {
        return $this->pendingRefundCPU;
    }

    /**
     * @return string|null
     */
    public function getPendingRefundNetwork(): ?string
    {
        return $this->pendingRefundNetwork;
    }

    /**
     * @return string|null
     */
    public function getBlockHash(): ?string
    {
        return $this->blockHash;
    }

}