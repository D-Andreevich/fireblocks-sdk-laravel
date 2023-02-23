<?php

namespace FireblocksSdkLaravel\Types;

use FireblocksSdkLaravel\Types\Enums\PeerEnums;

class TransferPeerPathResponse
{
    private PeerEnums $type;    //		[ VAULT_ACCOUNT, EXCHANGE_ACCOUNT, INTERNAL_WALLET, EXTERNAL_WALLET, ONE_TIME_ADDRESS, NETWORK_CONNECTION, FIAT_ACCOUNT, COMPOUND, UNKNOWN ].
    private string    $id;      //		The ID of the exchange account to return.
    private string    $name;    //		The name of the exchange account.
    private string    $subType; //		The specific exchange, fiat account or unmanaged wallet (either INTERNAL / EXTERNAL).

    public function __construct(
        string $type,
        string $id,
        string $name,
        string $subType
    )
    {
        $this->type    = PeerEnums::{$type}();
        $this->id      = $id;
        $this->name    = $name;
        $this->subType = $subType;
    }

    /**
     * @return PeerEnums
     */
    public function getType(): PeerEnums
    {
        return $this->type;
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
     * @return string
     */
    public function getSubType(): string
    {
        return $this->subType;
    }


}