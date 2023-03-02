<?php

namespace FireblocksSdkLaravel\Types\Enums;

class NetworkStatusEnums extends EnumCustom
{
    const _DROPPED      = 'DROPPED';      // Transaction that were dropped by the blockchain (for example wasn't accepted due to low fee)
    const _BROADCASTING = 'BROADCASTING'; // Broadcasting to the blockchain
    const _CONFIRMING   = 'CONFIRMING';   // Pending confirmations
    const _FAILED       = 'FAILED';       // The transaction has failed at the blockchain
    const _CONFIRMED    = 'CONFIRMED';    // Confirmed on the blockchain
}