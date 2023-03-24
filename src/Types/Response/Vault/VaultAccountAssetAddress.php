<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;

class VaultAccountAssetAddress
{
    private string $assetId;//	The ID of the asset
    private string $address;//	Address of the asset in a Vault Account, for BTC/LTC the address is in Segwit (Bech32) format, for BCH cash format.
    private string $legacyAddress;//	For BTC/LTC/BCH the legacy format address.
    private string $description;//	Description of the address.
    private string $tag;//	Destination tag for XRP, used as memo for EOS/XLM, for the fiat providers (Signet by Signature, SEN by Silvergate, BLINC by BCB Group), it is the Bank Transfer Description.
    private string $type;//	The type of address for the VaultAccount asset.
    private string $change;//	The change address for BTC transactions.
    private string $customerRefId;//	[optional] The ID for AML providers to associate the owner of funds with transactions.
    private ?int $bip44AddressIndex;//	[optional] The address_index, addressFormat, and enterpriseAddress in the derivation path of this address based on BIP44.

    /**
     * @param string $assetId
     * @param string $address
     * @param string $legacyAddress
     * @param string $description
     * @param string $tag
     * @param string $type
     * @param string $change
     * @param string $customerRefId
     * @param int|null $bip44AddressIndex
     */
    public function __construct(string $assetId, string $address, string $legacyAddress, string $description, string $tag, string $type, string $change, string $customerRefId, ?int $bip44AddressIndex = null)
    {
        $this->assetId = $assetId;
        $this->address = $address;
        $this->legacyAddress = $legacyAddress;
        $this->description = $description;
        $this->tag = $tag;
        $this->type = $type;
        $this->change = $change;
        $this->customerRefId = $customerRefId;
        $this->bip44AddressIndex = $bip44AddressIndex;
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
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getLegacyAddress(): string
    {
        return $this->legacyAddress;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getChange(): string
    {
        return $this->change;
    }

    /**
     * @return string
     */
    public function getCustomerRefId(): string
    {
        return $this->customerRefId;
    }

    /**
     * @return int|null
     */
    public function getBip44AddressIndex(): ?int
    {
        return $this->bip44AddressIndex;
    }
}