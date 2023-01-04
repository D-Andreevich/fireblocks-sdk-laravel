<?php

namespace DAndreevich\FireblocksSdkLaravel\Types\Enums;

class TransactionStatusEnums extends EnumCustom
{
    const     SUBMITTED                         = "SUBMITTED";
    const     QUEUED                            = "QUEUED";
    const     PENDING_SIGNATURE                 = "PENDING_SIGNATURE";
    const     PENDING_AUTHORIZATION             = "PENDING_AUTHORIZATION";
    const     PENDING_3RD_PARTY_MANUAL_APPROVAL = "PENDING_3RD_PARTY_MANUAL_APPROVAL";
    const     PENDING_3RD_PARTY                 = "PENDING_3RD_PARTY";
    const     PENDING                           = "PENDING"; # Deprecated
    const     BROADCASTING                      = "BROADCASTING";
    const     CONFIRMING                        = "CONFIRMING";
    const     CONFIRMED                         = "CONFIRMED"; # Deprecated
    const     COMPLETED                         = "COMPLETED";
    const     PENDING_AML_SCREENING             = "PENDING_AML_SCREENING";
    const     PARTIALLY_COMPLETED               = "PARTIALLY_COMPLETED";
    const     CANCELLING                        = "CANCELLING";
    const     CANCELLED                         = "CANCELLED";
    const     REJECTED                          = "REJECTED";
    const     FAILED                            = "FAILED";
    const     TIMEOUT                           = "TIMEOUT";
    const     BLOCKED                           = "BLOCKED";
}