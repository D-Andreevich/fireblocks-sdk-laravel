<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;


class VaultAccountAssetAddressList extends \FireblocksSdkLaravel\Types\Base\ArrayList
{
    /**
     * @var VaultAccountAssetAddress[]
     */
    protected array $list = [];

    public function __construct(array $dataArray)
    {
        foreach ($dataArray as $item) {
            $this->list[] = new VaultAccountAssetAddress(...$item);
        }
    }

    public function current(): VaultAccountAssetAddress
    {
        return parent::current();
    }
}