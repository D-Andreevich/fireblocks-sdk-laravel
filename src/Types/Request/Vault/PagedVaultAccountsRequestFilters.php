<?php

namespace FireblocksSdkLaravel\Types\Request\Vault;

use FireblocksSdkLaravel\Types\Request\Base\ToArray;
use FireblocksSdkLaravel\Types\Request\Base\ToArrayAccess;

class PagedVaultAccountsRequestFilters implements ToArrayAccess
{
    use ToArray;

    /**
     * Optional filters to apply for request
     * @param string|null $name_prefix (string, optional): Vault account name prefix
     * @param string|null $name_suffix (string, optional): Vault account name suffix
     * @param string|null $min_amount_threshold (number, optional):  The minimum amount for asset to have in order to be included in the results
     * @param string|null $asset_id (string, optional): The asset symbol
     * @param string|null $order_by (ASC/DESC, optional): Order of results by vault creation time (default: DESC)
     * @param int|null $limit (number, optional): Results page size
     * @param string|null $before (string, optional): cursor string received from previous request
     * @param string|null $after (string, optional): cursor string received from previous request
     * Constraints
     *   - You should only insert 'name_prefix' or 'name_suffix' (or none of them), but not both
     *   - You should only insert 'before' or 'after' (or none of them), but not both
     *   - For default and max 'limit' values please see: https://docs.fireblocks.com/api/swagger-ui/#/
     */
    public function __construct(string $name_prefix = null, string $name_suffix = null, string $min_amount_threshold = null, string $asset_id = null, string $order_by = null, int $limit = null, string $before = null, string $after = null)
    {
        $this->namePrefix = $name_prefix;
        $this->nameSuffix = $name_suffix;
        $this->minAmountThreshold = $min_amount_threshold;
        $this->assetId = $asset_id;
        $this->orderBy = $order_by;
        $this->limit = $limit;
        $this->before = $before;
        $this->after = $after;
    }

    /**
     * @return string|null
     */
    public function getAfter(): ?string
    {
        return $this->after;
    }

    /**
     * @return string|null
     */
    public function getAssetId(): ?string
    {
        return $this->assetId;
    }

    /**
     * @return string|null
     */
    public function getBefore(): ?string
    {
        return $this->before;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @return string|null
     */
    public function getMinAmountThreshold(): ?string
    {
        return $this->minAmountThreshold;
    }

    /**
     * @return string|null
     */
    public function getNamePrefix(): ?string
    {
        return $this->namePrefix;
    }

    /**
     * @return string|null
     */
    public function getNameSuffix(): ?string
    {
        return $this->nameSuffix;
    }

    /**
     * @return string|null
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

}