<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;

use FireblocksSdkLaravel\Types\Request\Base\ToArray;
use FireblocksSdkLaravel\Types\Request\Base\ToArrayAccess;

class VaultAccount implements ToArrayAccess
{
    use ToArray;

    private string $id;    //	The ID of the Vault Account.
    private string $name;    //	Name of the Vault Account.
    private bool $hiddenOnUI;    //	Specifies whether this vault account is visible in the web console or not.
    private ?string $customerRefId;    //	[optional] The ID for AML providers to associate the owner of funds with transactions.
    private bool $autoFuel;    //	Specifies whether this account's Ethereum address is auto fueled by the Gas Station or not.
    private VaultAssetList $assets;    // array of VaultAsset	List of assets under this Vault Account.

    /**
     * @param string $id
     * @param string $name
     * @param bool $hiddenOnUI
     * @param string|null $customerRefId
     * @param bool $autoFuel
     * @param array $assets
     */
    public function __construct(string $id, string $name, bool $hiddenOnUI, bool $autoFuel, array $assets, ?string $customerRefId = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->hiddenOnUI = $hiddenOnUI;
        $this->customerRefId = $customerRefId;
        $this->autoFuel = $autoFuel;
        $this->assets = new VaultAssetList($assets);
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
     * @return bool
     */
    public function isHiddenOnUI(): bool
    {
        return $this->hiddenOnUI;
    }

    /**
     * @return string|null
     */
    public function getCustomerRefId(): ?string
    {
        return $this->customerRefId;
    }

    /**
     * @return bool
     */
    public function isAutoFuel(): bool
    {
        return $this->autoFuel;
    }

    /**
     * @return VaultAssetList
     */
    public function getAssets(): VaultAssetList
    {
        return $this->assets;
    }

}