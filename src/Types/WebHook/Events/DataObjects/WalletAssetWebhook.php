<?php

namespace FireblocksSdkLaravel\Types\WebHook\Events\DataObjects;

use FireblocksSdkLaravel\Types\WebHook\Events\EventData;

class WalletAssetWebhook implements EventData
{
    private string $assetId;        //	The wallet's asset.
    private string $walletId;       //	The ID of the wallet.
    private string $walletName;     //	The name of wallet.
    private string $address;        //	The address of the wallet.
    private string $tag;            //	For XRP wallets, the destination tag; for EOS/XLM, the memo; for the fiat providers (Signet by Signature, SEN by Silvergate, or BLINC by BCB Group), the Bank Transfer Description.
    private string $activationTime; //	The time the wallet will be activated in case wallets activation postponed according to workspace definition.

    public function __construct(string $assetId, string $walletId, string $walletName, string $address, string $tag, string $activationTime)
    {
        $this->assetId        = $assetId;
        $this->walletId       = $walletId;
        $this->walletName     = $walletName;
        $this->address        = $address;
        $this->tag            = $tag;
        $this->activationTime = $activationTime;
    }

    /**
     * @return string
     */
    public function getAssetId(): string
    {
        return $this->assetId;
    }

    /**
     * @return string
     */
    public function getWalletId(): string
    {
        return $this->walletId;
    }

    /**
     * @return string
     */
    public function getWalletName(): string
    {
        return $this->walletName;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @return string
     */
    public function getActivationTime(): string
    {
        return $this->activationTime;
    }

}