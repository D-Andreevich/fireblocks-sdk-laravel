<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;


class UnspentInputsDataList extends \FireblocksSdkLaravel\Types\Base\ArrayList
{
    /**
     * @var UnspentInputsData[]
     */
    protected array $list = [];

    public function __construct(array $dataArray)
    {
        foreach ($dataArray as $item) {
            $this->list[] = new UnspentInputsData(...$item);
        }
    }

    public function current(): UnspentInputsData
    {
        return parent::current();
    }
}