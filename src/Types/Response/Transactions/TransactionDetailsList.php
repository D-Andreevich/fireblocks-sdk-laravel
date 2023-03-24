<?php

namespace FireblocksSdkLaravel\Types\Response\Transactions;


use FireblocksSdkLaravel\Types\Base\ArrayList;

class TransactionDetailsList extends ArrayList
{
    /**
     * @var TransactionDetails[]
     */
    protected array $list = [];

    public function __construct(array $dataArray)
    {
        foreach ($dataArray as $item) {
            $this->list[] = new TransactionDetails(...$item);
        }
    }

    public function current(): TransactionDetails
    {
        return parent::current();
    }
}