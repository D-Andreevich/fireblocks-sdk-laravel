<?php
namespace FireblocksSdkLaravel\Types\WebHook\Events\DataObjects;

use FireblocksSdkLaravel\Types\WebHook\Events\EventData;

class AssetAddedData implements EventData
{
    private string $accountId;   //	The ID of the vault account under which the wallet was added.
    private string $tenantId;    //	Unique id of your Fireblocks' workspace.
    private string $accountName; //	The name of the vault account under which the wallet was added.
    private string $assetId;     //	Wallet's asset

    public function __construct(string $accountId, string $tenantId, string $accountName, string $assetId)
    {
        $this->accountId   = $accountId;
        $this->tenantId    = $tenantId;
        $this->accountName = $accountName;
        $this->assetId     = $assetId;
    }

    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    /**
     * @return string
     */
    public function getAccountName(): string
    {
        return $this->accountName;
    }

    /**
     * @return string
     */
    public function getAssetId(): string
    {
        return $this->assetId;
    }


}