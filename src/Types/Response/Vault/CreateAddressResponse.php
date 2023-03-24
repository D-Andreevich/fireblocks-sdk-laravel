<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;

class CreateAddressResponse
{
    private string $address; //	Address of the asset in a Vault Account, for BTC/LTC the address is in Segwit (Bech32) format, cash address format for BCH.
    private string $legacyAddress; //	Legacy address format for BTC/LTC/BCH.
    private string $tag; //	Destination tag for XRP, used as memo for EOS/XLM.
    private ?int $bip44AddressIndex; //	The address_index in the derivation path of this address based on BIP44.

    /**
     * @param string $address
     * @param string $legacyAddress
     * @param string $tag
     * @param int|null $bip44AddressIndex
     */
    public function __construct(string $address, string $legacyAddress, string $tag, ?int $bip44AddressIndex = null)
    {
        $this->address = $address;
        $this->legacyAddress = $legacyAddress;
        $this->tag = $tag;
        $this->bip44AddressIndex = $bip44AddressIndex;
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
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @return int|null
     */
    public function getBip44AddressIndex(): ?int
    {
        return $this->bip44AddressIndex;
    }
}