<?php

namespace FireblocksSdkLaravel\Types\Response\Transactions;


use FireblocksSdkLaravel\Types\Base\ArrayList;

class SystemMessageInfoList extends ArrayList
{
    /**
     * @var SystemMessageInfo[]
     */
    protected array $list = [];

    public function __construct(array $dataArray)
    {
        foreach ($dataArray as $item) {
            $this->list[] = new SystemMessageInfo(...$item);
        }
    }

    public function current(): SystemMessageInfo
    {
        return parent::current();
    }
}