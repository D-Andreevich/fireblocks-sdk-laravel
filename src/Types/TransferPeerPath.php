<?php

namespace DAndreevich\FireblocksSdkLaravel\Types;

use DAndreevich\FireblocksSdkLaravel\Types\Enums\PeerEnums;

class TransferPeerPath
{
    /**
     * Defines a source or a destination for a transfer
     * @param PeerEnums $peer_type either PeerEnums::VAULT_ACCOUNT(), EXCHANGE_ACCOUNT, INTERNAL_WALLET, EXTERNAL_WALLET, FIAT_ACCOUNT, NETWORK_CONNECTION, ONE_TIME_ADDRESS or UNKNOWN_PEER
     * @param string|null $peer_id the account/wallet id
     */
    public function __construct(PeerEnums $peer_type, string $peer_id= null)
    {
        $this->type = (string)$peer_type;
        if ($peer_id != null) {
            $this->id = $peer_id;
        }
    }
}