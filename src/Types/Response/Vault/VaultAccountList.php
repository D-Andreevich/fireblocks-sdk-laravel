<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;

use FireblocksSdkLaravel\Types\WebHook\Events\DataObjects\VaultAccount;

class VaultAccountList extends \FireblocksSdkLaravel\Types\Base\ArrayList
{
    /**
     * @var VaultAccount[]
     */
    protected array $list = [];

    public function __construct(array $dataArray)
    {
        foreach ($dataArray as $item) {
            $this->list[] = new VaultAccount(...$item);
        }
    }

    public function current(): VaultAccount
    {
        return parent::current();
    }
}