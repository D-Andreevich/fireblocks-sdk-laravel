<?php

namespace FireblocksSDK\Types;

use FireblocksSDK\Types\Enums\PeerEnums;

class DestinationTransferPeerPath extends TransferPeerPath
{
    /**
     * Defines a destination for a transfer
     * @param PeerEnums $peer_type either PeerEnums::VAULT_ACCOUNT(), EXCHANGE_ACCOUNT, INTERNAL_WALLET, EXTERNAL_WALLET, FIAT_ACCOUNT, NETWORK_CONNECTION, ONE_TIME_ADDRESS or UNKNOWN_PEER
     * @param string|null $peer_id the account/wallet id
     * @param null $one_time_address (JSON object): The destination address (and tag) for a non whitelisted address.
     */
    public function __construct(PeerEnums $peer_type, string $peer_id=null, $one_time_address=null)
    {
        parent::__construct($peer_type, $peer_id);
        if ($one_time_address != null){
            $this->oneTimeAddress = $one_time_address;
        }

    }
}