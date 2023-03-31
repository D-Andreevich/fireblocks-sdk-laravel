<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;

class VaultAccountAssetAddress
{
    private string $assetId;//	The ID of the asset
    private string $address;//	Address of the asset in a Vault Account, for BTC/LTC the address is in Segwit (Bech32) format, for BCH cash format.
    private ?string $legacyAddress;//	For BTC/LTC/BCH the legacy format address.
    private ?string $description;//	Description of the address.
    private ?string $tag;//	Destination tag for XRP, used as memo for EOS/XLM, for the fiat providers (Signet by Signature, SEN by Silvergate, BLINC by BCB Group), it is the Bank Transfer Description.
    private ?string $type;//	The type of address for the VaultAccount asset.
    private ?string $change;//	The change address for BTC transactions.
    private ?string $customerRefId;//	[optional] The ID for AML providers to associate the owner of funds with transactions.
    private ?int $bip44AddressIndex;//	[optional] The address_index, addressFormat, and enterpriseAddress in the derivation path of this address based on BIP44.
    private ?string $enterpriseAddress;//	[optional]
    private ?string $addressFormat;//	[optional]
    private ?string $address_index;//	[optional]
    private ?bool $userDefined;//	[optional]

    /**
     * @param string $assetId
     * @param string $address
     * @param string|null $legacyAddress
     * @param string|null $description
     * @param string|null $tag
     * @param string|null $type
     * @param string|null $change
     * @param string|null $customerRefId
     * @param int|null $bip44AddressIndex
     * @param string|null $enterpriseAddress
     * @param string|null $addressFormat
     * @param string|null $address_index
     * @param bool|null $userDefined
     */
    public function __construct(string $assetId, string $address, ?string $legacyAddress = null, ?string $description = null, ?string $tag = null, ?string $type = null, ?string $change = null, ?string $customerRefId = null, ?int $bip44AddressIndex = null, ?string $enterpriseAddress = null, ?string $addressFormat = null, ?string $address_index = null,?bool $userDefined = false)
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
        $this->enterpriseAddress = $enterpriseAddress;
        $this->addressFormat = $addressFormat;
        $this->address_index = $address_index;
        $this->userDefined = $userDefined;
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
     * @return string|null
     */
    public function getLegacyAddress(): ?string
    {
        return $this->legacyAddress;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getChange(): ?string
    {
        return $this->change;
    }

    /**
     * @return string|null
     */
    public function getCustomerRefId(): ?string
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

    /**
     * @return string|null
     */
    public function getEnterpriseAddress(): ?string
    {
        return $this->enterpriseAddress;
    }

    /**
     * @return string|null
     */
    public function getAddressFormat(): ?string
    {
        return $this->addressFormat;
    }

    /**
     * @return string|null
     */
    public function getAddressIndex(): ?string
    {
        return $this->address_index;
    }

    /**
     * @return bool|null
     */
    public function getUserDefined(): ?bool
    {
        return $this->userDefined;
    }

}