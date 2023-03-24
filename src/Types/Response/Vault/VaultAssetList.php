<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;

class VaultAssetList extends \FireblocksSdkLaravel\Types\Base\ArrayList
{
    /**
     * @var VaultAsset[]
     */
    protected array $list = [];

    public function __construct(array $dataArray)
    {
        foreach ($dataArray as $item) {
            $this->list[] = new VaultAsset(...$item);
        }
    }

    public function current(): VaultAsset
    {
        return parent::current();
    }
}