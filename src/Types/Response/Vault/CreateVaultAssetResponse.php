<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;

class CreateVaultAssetResponse
{
    private string $id; //	The ID of the Vault Account.
    private string $address; //	Address of the asset in a Vault Account, for BTC/LTC the address is in Segwit (Bech32) format, cash address format for BCH.
    private string $legacyAddress; //	Legacy address format for BTC/LTC/BCH.
    private string $tag; //	Destination tag for XRP, used as memo for EOS/XLM.
    private string $eosAccountName; //	Returned for EOS, the account name.

    /**
     * @param string $id
     * @param string $address
     * @param string $legacyAddress
     * @param string $tag
     * @param string $eosAccountName
     */
    public function __construct(string $id, string $address, string $legacyAddress, string $tag, string $eosAccountName)
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
     * @return string
     */
    public function getEosAccountName(): string
    {
        return $this->eosAccountName;
    }

}