<?php

namespace FireblocksSdkLaravel\Types\Response\SupportedAssets;


use FireblocksSdkLaravel\Types\Base\ArrayList;

class AssetTypeResponseList extends ArrayList
{
    /**
     * @var AssetTypeResponse[]
     */
    protected array $list = [];

    public function __construct(array $dataArray)
    {
        foreach ($dataArray as $item) {
            $this->list[] = new AssetTypeResponse(...$item);
        }
    }

    public function current(): AssetTypeResponse
    {
        return parent::current();
    }
}