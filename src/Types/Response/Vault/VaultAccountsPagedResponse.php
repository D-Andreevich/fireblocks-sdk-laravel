<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;

use FireblocksSdkLaravel\Types\Response\Base\PagingData;

class VaultAccountsPagedResponse
{
    private VaultAccountList $accounts; //	Array of VaultAccount	List of vault account objects.
    private PagingData $paging; //	object	This object contains two fields: "before" (string) and “after” (string).
    private ?string $previousUrl; //	string	URL string of the request for the previous page.
    private ?string $nextUrl; //	string	URL string of the request for the next page.

    /**
     * @param array $accounts
     * @param array $paging
     * @param string|null $previousUrl
     * @param string|null $nextUrl
     */
    public function __construct(array $accounts, ?array $paging = [], ?string $previousUrl = null, ?string $nextUrl = null)
    {
        $this->accounts = new VaultAccountList($accounts);
        $this->paging = new PagingData(...$paging);
        $this->previousUrl = $previousUrl;
        $this->nextUrl = $nextUrl;
    }

    /**
     * @return VaultAccountList
     */
    public function getAccounts(): VaultAccountList
    {
        return $this->accounts;
    }

    /**
     * @return PagingData
     */
    public function getPaging(): PagingData
    {
        return $this->paging;
    }

    /**
     * @return string|null
     */
    public function getPreviousUrl(): ?string
    {
        return $this->previousUrl;
    }

    /**
     * @return string|null
     */
    public function getNextUrl(): ?string
    {
        return $this->nextUrl;
    }

}