<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;

class CreateVaultAssetResponse
{
    private string $id; //	The ID of the Vault Account.
    private ?string $address; //	Address of the asset in a Vault Account, for BTC/LTC the address is in Segwit (Bech32) format, cash address format for BCH.
    private ?string $legacyAddress; //	Legacy address format for BTC/LTC/BCH.
    private ?string $tag; //	Destination tag for XRP, used as memo for EOS/XLM.
    private ?string $eosAccountName; //	Returned for EOS, the account name.

    /**
     * @param string $id
     * @param string|null $address
     * @param string|null $legacyAddress
     * @param string|null $tag
     * @param string|null $eosAccountName
     */
    public function __construct(string $id, ?string $address = null, ?string $legacyAddress = null, ?string $tag = null, ?string $eosAccountName = null)
    {
        $this->id = $id;
        $this->address = $address;
        $this->legacyAddress = $legacyAddress;
        $this->tag = $tag;
        $this->eosAccountName = $eosAccountName;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
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
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @return string|null
     */
    public function getEosAccountName(): ?string
    {
        return $this->eosAccountName;
    }
}