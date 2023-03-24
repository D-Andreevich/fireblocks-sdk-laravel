<?php

namespace FireblocksSdkLaravel\Types\WebHook\Events;

use FireblocksSdkLaravel\Types\Enums\EventTypesEnums;
use FireblocksSdkLaravel\Types\Response\Transactions\TransactionDetails;

class TransactionStatusUpdated extends BaseEvent
{
    public function __construct(string $type = EventTypesEnums::_TRANSACTION_STATUS_UPDATED, string $tenantId, int $timestamp, array $data)
    {
        parent::__construct(EventTypesEnums::$type(), $tenantId, $timestamp, new TransactionDetails(...$data));
    }

    /**
     * @return TransactionDetails
     */
    public function getData(): TransactionDetails
    {
        return parent::getData();
    }


}