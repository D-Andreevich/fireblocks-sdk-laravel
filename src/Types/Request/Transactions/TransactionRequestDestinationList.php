<?php

namespace FireblocksSdkLaravel\Types\Request\Transactions;


use FireblocksSdkLaravel\Types\Base\ArrayList;

class TransactionRequestDestinationList extends ArrayList
{
    /**
     * @var TransactionRequestDestination[]
     */
    protected array $list = [];

    public function __construct(array $dataArray)
    {
        foreach ($dataArray as $item) {
            $this->list[] = new TransactionRequestDestination(...$item);
        }
    }

    public function current(): TransactionRequestDestination
    {
        return parent::current();
    }
}