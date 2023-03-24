<?php

namespace FireblocksSdkLaravel\Types\Response\Transactions;

use FireblocksSdkLaravel\Types\Enums\TransactionStatusEnums;

class CreateTransactionResponse
{
    private string $id; //		The ID of the transaction.
    private TransactionStatusEnums $status; //		Status of the transaction.
    private SystemMessageInfoList $systemMessages; //	 of SystemMessageInfo objects	A response from Fireblocks that communicates a message about the health of the process being performed. If this object is returned with data, you should expect potential delays or incomplete transaction statuses.

    /**
     * @param string $id
     * @param string $status
     * @param array $systemMessages
     */
    public function __construct(string $id, string $status, array $systemMessages)
    {
        $this->id = $id;
        $this->status = TransactionStatusEnums::{$status}();
        $this->systemMessages = new SystemMessageInfoList($systemMessages);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return TransactionStatusEnums
     */
    public function getStatus(): TransactionStatusEnums
    {
        return $this->status;
    }

    /**
     * @return SystemMessageInfoList
     */
    public function getSystemMessages(): SystemMessageInfoList
    {
        return $this->systemMessages;
    }


}