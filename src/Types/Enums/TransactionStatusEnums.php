<?php

namespace FireblocksSdkLaravel\Types\Enums;

class TransactionStatusEnums extends EnumCustom
{
    const     _SUBMITTED                         = "SUBMITTED";
    const     _QUEUED                            = "QUEUED";
    const     _PENDING_SIGNATURE                 = "PENDING_SIGNATURE";
    const     _PENDING_AUTHORIZATION             = "PENDING_AUTHORIZATION";
    const     _PENDING_3RD_PARTY_MANUAL_APPROVAL = "PENDING_3RD_PARTY_MANUAL_APPROVAL";
    const     _PENDING_3RD_PARTY                 = "PENDING_3RD_PARTY";
    const     _PENDING                           = "PENDING"; # Deprecated
    const     _BROADCASTING                      = "BROADCASTING";
    const     _CONFIRMING                        = "CONFIRMING";
    const     _CONFIRMED                         = "CONFIRMED"; # Deprecated
    const     _COMPLETED                         = "COMPLETED";
    const     _PENDING_AML_SCREENING             = "PENDING_AML_SCREENING";
    const     _PARTIALLY_COMPLETED               = "PARTIALLY_COMPLETED";
    const     _CANCELLING                        = "CANCELLING";
    const     _CANCELLED                         = "CANCELLED";
    const     _REJECTED                          = "REJECTED";
    const     _FAILED                            = "FAILED";
    const     _TIMEOUT                           = "TIMEOUT";
    const     _BLOCKED                           = "BLOCKED";
}