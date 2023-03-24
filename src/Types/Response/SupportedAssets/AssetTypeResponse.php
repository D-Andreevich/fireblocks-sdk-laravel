<?php

namespace FireblocksSdkLaravel\Types\Response\SupportedAssets;

class AssetTypeResponse
{
    private string $id; //	The ID of the asset.
    private string $name; //	The name of the asset.
    private string $type; //	The type of asset being used by the network. [Valid Values: ALGO_ASSET, BASE_ASSET, BEP20, COMPOUND, ERC20, FIAT, SOL_ASSET, TRON_TRC20, XLM_ASSET, XDB_ASSET].
    private ?string $contractAddress; //	[Optional] The smart contract address used for deposit and withdrawal. (Note: This parameter is for blockchains that us a contract address, such as EVM-based blockchains.)
    private ?string $nativeAsset; //	[Optional] The name of the native asset.
    private ?int $decimals; //	[Optional] The number of digits after the decimal point.

    /**
     * @param string $id
     * @param string $name
     * @param string $type
     * @param string|null $contractAddress
     * @param string|null $nativeAsset
     * @param int|null $decimals
     */
    public function __construct(string $id, string $name, string $type, ?string $contractAddress = null, ?string $nativeAsset = null, ?int $decimals = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->contractAddress = $contractAddress;
        $this->nativeAsset = $nativeAsset;
        $this->decimals = $decimals;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getContractAddress(): ?string
    {
        return $this->contractAddress;
    }

    /**
     * @return string|null
     */
    public function getNativeAsset(): ?string
    {
        return $this->nativeAsset;
    }

    /**
     * @return int|null
     */
    public function getDecimals(): ?int
    {
        return $this->decimals;
    }
}