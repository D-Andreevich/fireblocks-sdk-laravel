<?php
namespace FireblocksSdkLaravel\Types\WebHook\Events\DataObjects;

use FireblocksSdkLaravel\Types\VaultAsset;
use FireblocksSdkLaravel\Types\WebHook\Events\EventData;

class VaultAccount implements EventData
{
    private string $id;         //	The ID of the Vault Account.
    private string $name;       // 	Name of the Vault Account.
    private bool   $hiddenOnUI; // Specifies whether this vault account is visible in the web console or not.
    private array $assets;     // Array of VaultAsset	List of assets under this Vault Account.

    public function __construct(string $id, string $name, bool $hiddenOnUI, array $assets)
    {
        $this->id         = $id;
        $this->name       = $name;
        $this->hiddenOnUI = $hiddenOnUI;
        foreach ($assets as $item){
            $this->assets[] = new VaultAsset(...$item);
        }
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
     * @return array<VaultAsset>
     */
    public function getAssets(): array
    {
        return $this->assets;
    }


}