<?php

namespace FireblocksSdkLaravel\Types\WebHook\Events\DataObjects;

use FireblocksSdkLaravel\Types\Response\Vault\VaultAssetList;
use FireblocksSdkLaravel\Types\WebHook\Events\EventData;

class VaultAccount implements EventData
{
    private string $id;         //	The ID of the Vault Account.
    private string $name;       // 	Name of the Vault Account.
    private bool $hiddenOnUI; // Specifies whether this vault account is visible in the web console or not.
    private VaultAssetList $assets;     // Array of VaultAsset	List of assets under this Vault Account.

    public function __construct(string $id, string $name, bool $hiddenOnUI, array $assets)
    {
        $this->id = $id;
        $this->name = $name;
        $this->hiddenOnUI = $hiddenOnUI;
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
     * @return VaultAssetList
     */
    public function getAssets(): VaultAssetList
    {
        return $this->assets;
    }


}