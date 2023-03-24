<?php

namespace FireblocksSdkLaravel\Types\Response\Transactions;

use FireblocksSdkLaravel\Types\Response\Base\PageDetails;
use FireblocksSdkLaravel\Types\Response\Base\PagingData;

class TransactionDetailsPagedResponse
{
    private TransactionDetailsList $transactions;
    private PageDetails $pageDetails;

    /**
     * @param array $transactions
     * @param array $pageDetails
     */
    public function __construct(array $transactions, array $pageDetails)
    {
        $this->transactions = new TransactionDetailsList($transactions);
        $this->pageDetails = new PageDetails(...$pageDetails);
    }

    /**
     * @return TransactionDetailsList
     */
    public function getTransactions(): TransactionDetailsList
    {
        return $this->transactions;
    }

    /**
     * @return PageDetails
     */
    public function getPageDetails(): PageDetails
    {
        return $this->pageDetails;
    }


}