<?php

namespace FireblocksSdkLaravel;


use FireblocksSdkLaravel\Exceptions\FireblocksApiException;
use FireblocksSdkLaravel\Http\FireblocksApiClient;
use FireblocksSdkLaravel\Types\DestinationTransferPeerPath;
use FireblocksSdkLaravel\Types\Enums\FeeLevelEnums;
use FireblocksSdkLaravel\Types\Enums\SigningAlgorithmEnums;
use FireblocksSdkLaravel\Types\Enums\TransactionEnums;
use FireblocksSdkLaravel\Types\Request\Transactions\CreateRawTransactionParameters;
use FireblocksSdkLaravel\Types\Request\Transactions\CreateTransactionParameters;
use FireblocksSdkLaravel\Types\Request\Transactions\ListTransactionsParameters;
use FireblocksSdkLaravel\Types\Request\Vault\PagedVaultAccountsRequestFilters;
use FireblocksSdkLaravel\Types\Response\SupportedAssets\AssetTypeResponseList;
use FireblocksSdkLaravel\Types\Response\Transactions\AddressStatus;
use FireblocksSdkLaravel\Types\Response\Transactions\CreateTransactionResponse;
use FireblocksSdkLaravel\Types\Response\Transactions\NetworkFee;
use FireblocksSdkLaravel\Types\Response\Transactions\SetConfirmationsThresholdResponse;
use FireblocksSdkLaravel\Types\Response\Transactions\TransactionDetails;
use FireblocksSdkLaravel\Types\Response\Transactions\TransactionDetailsList;
use FireblocksSdkLaravel\Types\Response\Transactions\TransactionDetailsPagedResponse;
use FireblocksSdkLaravel\Types\Response\Vault\CreateAddressResponse;
use FireblocksSdkLaravel\Types\Response\Vault\CreateVaultAssetResponse;
use FireblocksSdkLaravel\Types\Response\Vault\PublicKey;
use FireblocksSdkLaravel\Types\Response\Vault\UnspentInputsDataList;
use FireblocksSdkLaravel\Types\Response\Vault\VaultAccountAssetAddressList;
use FireblocksSdkLaravel\Types\Response\Vault\VaultAccountList;
use FireblocksSdkLaravel\Types\Response\Vault\VaultAccountsPagedResponse;
use FireblocksSdkLaravel\Types\Response\Vault\VaultAsset;
use FireblocksSdkLaravel\Types\Response\Vault\VaultAssetList;
use FireblocksSdkLaravel\Types\TransactionDestination;
use FireblocksSdkLaravel\Types\TransferPeerPath;
use FireblocksSdkLaravel\Types\TransferTicketTerm;
use FireblocksSdkLaravel\Types\WebHook\Events\DataObjects\VaultAccount;

/**
 *
 */
class FireblocksSdkClient
{
    /**
     * Creates a new Fireblocks API Client.
     * @throws FireblocksApiException
     */
    public function __construct()
    {
        $config = config('fireblocks');
        if (!file_exists($config['private_key_path'])) {
            throw new FireblocksApiException('File not exists by [private_key_path], please check config');
        }
        $private_key = file_get_contents($config['private_key_path']);
        $api_key = $config['api_key'];
        $api_base_url = $config['api_base_url'];
        $timeout = $config['timeout'];
        $this->apiClient = new FireblocksApiClient($private_key, $api_key, $api_base_url, $timeout);
    }

    /**
     * @param string $id
     * @return Types\Response\Base\ResponseData
     */
    public function get_nft(string $id): Types\Response\Base\ResponseData
    {
        return $this->apiClient->get_request("/v1/nfts/tokens/" . $id);
    }


    /**
     * @param array $ids
     * @param string $page_cursor
     * @param int $page_size
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_nfts(array $ids, string $page_cursor = '', int $page_size = 100): Types\Response\Base\ResponseData
    {
        /**
         *     $ids    Example list: "1,2,3,4"
         */
        if (count($ids) <= 0) {
            throw new FireblocksApiException("Invalid token_ids. Should contain at least 1 token id");
        }


        $params = [
            "ids" => implode(",", $ids),
        ];

        if ($page_cursor) {
            $params['pageCursor'] = $page_cursor;
        }
        if ($page_size) {
            $params['pageSize'] = $page_size;
        }

        return $this->apiClient->get_request("/v1/nfts/tokens", $params);

    }

    /**
     * @param string $id
     * @return Types\Response\Base\ResponseData
     */
    public function refresh_nft_metadata(string $id): Types\Response\Base\ResponseData
    {
        return $this->apiClient->put_request("/v1/nfts/tokens/" . $id);
    }

    /**
     * @param string $blockchain_descriptor
     * @param string $vault_account_id
     * @return Types\Response\Base\ResponseData
     */
    public function refresh_nft_ownership_by_vault(string $blockchain_descriptor, string $vault_account_id): Types\Response\Base\ResponseData
    {
        $params = [];
        if ($blockchain_descriptor) {
            $params['blockchainDescriptor'] = $blockchain_descriptor;
        }
        if ($vault_account_id) {
            $params['vaultAccountId'] = $vault_account_id;
        }

        return $this->apiClient->get_request("/v1/nfts/ownership/tokens", $params);
    }

    /**
     * Gets a list of owned NFT tokens
     * @param string $blockchain_descriptor The blockchain descriptor (based on legacy asset)
     * @param string $vault_account_id The vault account ID
     * @param array|null $ids List of token ids to fetch
     * @param string $page_cursor
     * @param int $page_size
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_owned_nfts(string $blockchain_descriptor, string $vault_account_id, array $ids = null,
                                   string $page_cursor = '', int $page_size = 100)
    {

        $params = [];

        if ($blockchain_descriptor) {
            $params['blockchainDescriptor'] = $blockchain_descriptor;
        }
        if ($vault_account_id) {
            $params['vaultAccountId'] = $vault_account_id;
        }
        if ($ids) {
            $params['ids'] = implode(",", $ids);
        }
        if ($page_cursor) {
            $params['pageCursor'] = $page_cursor;
        }
        if ($page_size) {
            $params['pageSize'] = $page_size;
        }

        return $this->apiClient->get_request("/v1/nfts/ownership/tokens", $params);
    }

    /**
     * Gets all assets that are currently supported by Fireblocks
     ** @return AssetTypeResponseList
     */
    public function get_supported_assets(): AssetTypeResponseList
    {
        $responseData = $this->apiClient->get_request("/v1/supported_assets");
        return new AssetTypeResponseList($responseData->getData());
    }

    /**
     * Gets all vault accounts for your tenant
     * @param string|null $name_prefix Vault account name prefix
     * @param string|null $name_suffix Vault account name suffix
     * @param int|null $min_amount_threshold The minimum amount for asset to have in order to be included in the results
     * @param string|null $assetId The asset symbol
     * @return VaultAccountList
     */
    public function get_vault_accounts(string $name_prefix = null, string $name_suffix = null, int $min_amount_threshold = null, string $assetId = null): VaultAccountList
    {
        $params = [];

        if ($name_prefix) {
            $params['namePrefix'] = $name_prefix;
        }

        if ($name_suffix) {
            $params['nameSuffix'] = $name_suffix;
        }

        if ($min_amount_threshold) {
            $params['minAmountThreshold'] = $min_amount_threshold;
        }

        if ($assetId) {
            $params['assetId'] = $assetId;
        }

        $responseData = $this->apiClient->get_request("/v1/vault/accounts", $params);
        return new VaultAccountList($responseData->getData());
    }

    /**
     * Gets a page of vault accounts for your tenant according to filters given
     * @param PagedVaultAccountsRequestFilters $paged_vault_accounts_request_filters Possible filters to apply for request
     * @return VaultAccountsPagedResponse
     */
    public function get_vault_accounts_with_page_info(PagedVaultAccountsRequestFilters $paged_vault_accounts_request_filters): VaultAccountsPagedResponse
    {
        $params = $paged_vault_accounts_request_filters->toArray();

        $responseData = $this->apiClient->get_request("/v1/vault/accounts_paged", $params);
        return new VaultAccountsPagedResponse(...$responseData->getData());
    }

    /**
     * Gets a single vault account
     * @param string $vault_account_id The id of the requested account
     * @return VaultAccount
     */
    public function get_vault_account(string $vault_account_id): VaultAccount
    {
        $responseData = $this->apiClient->get_request("/v1/vault/accounts/{$vault_account_id}");
        return new VaultAccount(...$responseData->getData());
    }

    /**
     * Gets a single vault account asset
     * @param string $vault_account_id The id of the requested account
     * @param string $asset_id The symbol of the requested asset (e.g BTC, ETH)
     * @return VaultAsset
     */
    public function get_vault_account_asset(string $vault_account_id, string $asset_id): VaultAsset
    {
        $responseData = $this->apiClient->get_request("/v1/vault/accounts/{$vault_account_id}/{$asset_id}");
        return new VaultAsset(...$responseData->getData());
    }

    /**
     * Gets a single vault account asset after forcing refresh from the blockchain
     * @param string $vault_account_id The id of the requested account
     * @param string $asset_id The symbol of the requested asset (e.g BTC, ETH)
     * @param string|null $idempotency_key
     * @return VaultAsset
     */
    public function refresh_vault_asset_balance(string $vault_account_id, string $asset_id, string $idempotency_key = null): VaultAsset
    {
        $responseData = $this->apiClient->post_request("/v1/vault/accounts/{$vault_account_id}/{$asset_id}/balance", [], $idempotency_key);
        return new VaultAsset(...$responseData->getData());
    }

    /**
     * Gets deposit addresses for an asset in a vault account
     * @param string $vault_account_id The id of the requested account
     * @param string $asset_id The symbol of the requested asset (e.g BTC, ETH)
     * @return VaultAccountAssetAddressList
     */
    public function get_deposit_addresses(string $vault_account_id, string $asset_id): VaultAccountAssetAddressList
    {
        $responseData = $this->apiClient->get_request("/v1/vault/accounts/{$vault_account_id}/{$asset_id}/addresses");
        return new VaultAccountAssetAddressList($responseData->getData());
    }

    /**
     * Gets utxo list for an asset in a vault account
     * @param string $vault_account_id The id of the requested account
     * @param string $asset_id The symbol of the requested asset (like BTC, DASH and utxo based assets)
     * @return UnspentInputsDataList
     */
    public function get_unspent_inputs(string $vault_account_id, string $asset_id): UnspentInputsDataList
    {
        $responseData = $this->apiClient->get_request("/v1/vault/accounts/{$vault_account_id}/{$asset_id}/unspent_inputs");
        return new UnspentInputsDataList($responseData->getData());
    }

    /**
     * Generates a new address for an asset in a vault account
     * @param string $vault_account_id The vault account ID
     * @param string $asset_id The ID of the asset for which to generate the deposit address
     * @param string|null $description A description for the new address
     * @param string|null $customer_ref_id The ID for AML providers to associate the owner of funds with transactions
     * @param string|null $idempotency_key
     * @return CreateAddressResponse
     */
    public function generate_new_address(string $vault_account_id, string $asset_id, string $description = null, string $customer_ref_id = null, string $idempotency_key = null): CreateAddressResponse
    {
        $responseData = $this->apiClient->post_request("/v1/vault/accounts/{$vault_account_id}/{$asset_id}/addresses",
            [
                "description" => $description ?? '', "customerRefId" => $customer_ref_id ?? ''
            ],
            $idempotency_key);
        return new CreateAddressResponse(...$responseData->getData());
    }

    /**
     * Sets the description of an existing address
     * @param string $vault_account_id The vault account ID
     * @param string $asset_id The ID of the asset
     * @param string $address The address for which to set the set_address_description
     * @param string|null $tag The XRP tag, or EOS memo, for which to set the description
     * @param string|null $description The description to set, or none for no description
     * @return mixed
     */
    public function set_address_description(string $vault_account_id, string $asset_id, string $address, string $tag = null, string $description = null)
    {
        $path = "/v1/vault/accounts/{$vault_account_id}/{$asset_id}/addresses/{$address}";
        if ($tag) {
            $path = "{$path}:{$tag}";
        }

        return $this->apiClient->put_request($path,
            [
                "description" => $description ?? ''
            ])->getData();

    }

    /**
     * Gets all network connections for your tenant
     * @return Types\Response\Base\ResponseData
     */
    public function get_network_connections()
    {
        return $this->apiClient->get_request("/v1/network_connections");
    }

    /**
     *  Creates a network connection
     * @param string $local_network_id The local netowrk profile's id
     * @param string $remote_network_id The remote network profile's id
     * @param array $routing_policy The desired routing policy for the connection
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function create_network_connection(string $local_network_id, string $remote_network_id, array $routing_policy = [], string $idempotency_key = null)
    {
        $body = [
            "localNetworkId" => $local_network_id,
            "remoteNetworkId" => $remote_network_id,
            "routingPolicy" => $routing_policy
        ];

        return $this->apiClient->post_request("/v1/network_connections", $body, $idempotency_key);
    }

    /**
     * Gets a single network connection
     * @param string $connection_id The network connection's id
     */
    public function get_network_connection_by_id(string $connection_id): Types\Response\Base\ResponseData
    {
        return $this->apiClient->get_request("/v1/network_connections/{$connection_id}");
    }

    /**
     * Removes a network connection
     * @param string $connection_id The network connection's id
     * @throws FireblocksApiException
     */
    public function remove_network_connection(string $connection_id): Types\Response\Base\ResponseData
    {
        return $this->apiClient->delete_request("/v1/network_connections/{$connection_id}");
    }

    /**
     *  Sets routing policy for a network connection
     * @param string $connection_id The network connection's id
     * @param array $routing_policy The desired routing policy
     * @return Types\Response\Base\ResponseData
     */
    public function set_network_connection_routing_policy(string $connection_id, array $routing_policy = [])
    {
        $body = [
            "routingPolicy" => $routing_policy
        ];

        return $this->apiClient->patch_request("/v1/network_connections/{$connection_id}/set_routing_policy", $body);
    }

    /**
     * Gets all discoverable network profiles
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_discoverable_network_ids()
    {
        return $this->apiClient->get_request("/v1/network_ids");
    }

    /**
     *  Creates a new network profile
     * @param string $name A name for the new network profile
     * @param array $routing_policy The desired routing policy for the network
     * @return Types\Response\Base\ResponseData
     */
    public function create_network_id(string $name, array $routing_policy = [])
    {
        $body = [
            "name" => $name,
            "routingPolicy" => $routing_policy
        ];

        return $this->apiClient->post_request("/v1/network_ids", $body);
    }

    /**
     *  Gets a single network profile
     * @param string $network_id The network profile's id
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_network_id(string $network_id)
    {
        return $this->apiClient->get_request("/v1/network_ids/{$network_id}");
    }

    /**
     *  Sets discoverability for network profile
     * @param string $network_id The network profile's id
     * @param bool $is_discoverable he desired discoverability to set
     * @return Types\Response\Base\ResponseData
     */
    public function set_network_id_discoverability(string $network_id, bool $is_discoverable)
    {
        $body = [
            "isDiscoverable" => $is_discoverable
        ];

        return $this->apiClient->patch_request("/v1/network_ids/{$network_id}/set_discoverability", $body);
    }

    /**
     *  Sets routing policy for network profile
     * @param string $network_id The network profile's id
     * @param array $routing_policy The desired routing policy
     * @return Types\Response\Base\ResponseData
     */
    public function set_network_id_routing_policy(string $network_id, array $routing_policy = [])
    {
        $body = [
            "routingPolicy" => $routing_policy
        ];

        return $this->apiClient->patch_request("/v1/network_ids/{$network_id}/set_routing_policy", $body);
    }

    /**
     * Gets all exchange accounts for your tenant
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_exchange_accounts()
    {
        return $this->apiClient->get_request("/v1/exchange_accounts");
    }

    /**
     *  Gets an exchange account for your tenant
     * @param string $exchange_account_id The exchange ID in Fireblocks
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_exchange_account(string $exchange_account_id)
    {
        return $this->apiClient->get_request("/v1/exchange_accounts/{$exchange_account_id}");
    }

    /**
     *  Get a specific asset from an exchange account
     * @param string $exchange_account_id The exchange ID in Fireblocks
     * @param string $asset_id The asset to transfer
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_exchange_account_asset(string $exchange_account_id, string $asset_id)
    {
        return $this->apiClient->get_request("/v1/exchange_accounts/{$exchange_account_id}/{$asset_id}");
    }


    /**
     * Transfer to a subaccount from a main exchange account
     * @param string $exchange_account_id The exchange ID in Fireblocks
     * @param string $subaccount_id The ID of the subaccount in the exchange
     * @param string $asset_id The asset to transfer
     * @param double $amount The amount to transfer
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function transfer_to_subaccount(string $exchange_account_id, string $subaccount_id, string $asset_id, float $amount, string $idempotency_key = null)
    {
        settype($amount, "double");

        $body = [
            "subaccountId" => $subaccount_id,
            "amount" => $amount
        ];

        return $this->apiClient->post_request("/v1/exchange_accounts/{$exchange_account_id}/{$asset_id}/transfer_to_subaccount",
            $body, $idempotency_key);
    }

    /**
     * Transfer from a subaccount to a main exchange account
     * @param string $exchange_account_id The exchange ID in Fireblocks
     * @param string $subaccount_id The ID of the subaccount in the exchange
     * @param string $asset_id The asset to transfer
     * @param double $amount The amount to transfer
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function transfer_from_subaccount(string $exchange_account_id, string $subaccount_id, string $asset_id, float $amount, string $idempotency_key = null)
    {
        settype($amount, "double");
        $body = [
            "subaccountId" => $subaccount_id,
            "amount" => $amount
        ];

        return $this->apiClient->post_request("/v1/exchange_accounts/{$exchange_account_id}/{$asset_id}/transfer_from_subaccount",
            $body, $idempotency_key);
    }

    /**
     * Gets all fiat accounts for your tenant
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_fiat_accounts()
    {
        return $this->apiClient->get_request("/v1/fiat_accounts");
    }

    /**
     * Gets a single fiat account by ID
     * @param string $account_id The fiat account ID
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_fiat_account_by_id(string $account_id)
    {
        return $this->apiClient->get_request("/v1/fiat_accounts/{$account_id}");
    }

    /**
     * Redeem from a fiat account to a linked DDA
     * @param string $account_id The fiat account ID in Fireblocks
     * @param double $amount The amount to transfer
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function redeem_to_linked_dda(string $account_id, float $amount, string $idempotency_key = null)
    {
        settype($amount, "double");
        $body = [
            "amount" => $amount,
        ];

        return $this->apiClient->post_request("/v1/fiat_accounts/{$account_id}/redeem_to_linked_dda", $body, $idempotency_key);
    }

    /**
     * Deposit to a fiat account from a linked DDA
     * @param string $account_id The fiat account ID in Fireblocks
     * @param double $amount The amount to transfer
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function deposit_from_linked_dda(string $account_id, float $amount, string $idempotency_key = null)
    {
        settype($amount, "double");
        $body = [
            "amount" => $amount,
        ];

        return $this->apiClient->post_request("/v1/fiat_accounts/{$account_id}/deposit_from_linked_dda", $body, $idempotency_key);
    }

    /**
     * Gets a list of transactions matching the given filters or path.
     * Note that "next_or_previous_path" is mutually exclusive with other parameters.
     * If you wish to iterate over the nextPage/prevPage pages, please provide only the "next_or_previous_path" parameter from `pageDetails` response
     * example:
     * get_transactions_with_page_info(next_or_previous_path=response[pageDetails][nextPage])
     * @param ListTransactionsParameters $listTransactionsParameters
     * @param string|null $next_or_previous_path get transactions matching the path, provided from pageDetails
     * @return TransactionDetailsPagedResponse
     */
    public function get_transactions_with_page_info(ListTransactionsParameters $listTransactionsParameters, string $next_or_previous_path = null): TransactionDetailsPagedResponse
    {
        if (isset($next_or_previous_path)) {
            if (empty($next_or_previous_path)) {
                $paginateResponseData = [
                    'transactions' => [],
                    'pageDetails' => [
                        'prevPage' => '',
                        'nextPage' => ''
                    ]
                ];
            } else {
                $index = strpos($next_or_previous_path, '/v1/');
                $length = strlen($next_or_previous_path) - 1;
                $suffix_path = substr($next_or_previous_path, $index, $length + $index);
                $paginateResponseData = $this->apiClient->get_request_paginate($suffix_path);
            }
        } else {
            $paginateResponseData = $this->apiClient->get_request_paginate("/v1/transactions", $listTransactionsParameters->toArray());
        }

        return new TransactionDetailsPagedResponse(...$paginateResponseData);
    }

    /**
     * Gets a list of transactions matching the given filters
     * @param ListTransactionsParameters $listTransactionsParameters
     * @return TransactionDetailsList
     */
    public function get_transactions(ListTransactionsParameters $listTransactionsParameters): TransactionDetailsList
    {
        $responseData = $this->apiClient->get_request("/v1/transactions", $listTransactionsParameters->toArray());
        return new TransactionDetailsList($responseData->getData());
    }

    /**
     * Gets all internal wallets for your tenant
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_internal_wallets()
    {
        return $this->apiClient->get_request("/v1/internal_wallets");
    }

    /**
     * Gets an internal wallet from your tenant
     * @param string $wallet_id The wallet id to query
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_internal_wallet(string $wallet_id)
    {
        return $this->apiClient->get_request("/v1/internal_wallets/{$wallet_id}");
    }

    /**
     * Gets an asset from an internal wallet from your tenant
     * @param string $wallet_id The wallet id to query
     * @param string $asset_id The asset id to query
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_internal_wallet_asset(string $wallet_id, string $asset_id)
    {
        return $this->apiClient->get_request("/v1/internal_wallets/{$wallet_id}/{$asset_id}");
    }

    /**
     * Gets all external wallets for your tenant"""
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_external_wallets()
    {
        return $this->apiClient->get_request("/v1/external_wallets");
    }

    /**
     * Gets an external wallet from your tenant
     * @param string $wallet_id The wallet id to query
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_external_wallet(string $wallet_id)
    {
        return $this->apiClient->get_request("/v1/external_wallets/{$wallet_id}");
    }

    /**
     * Gets an asset from an external wallet from your tenant
     * @param string $wallet_id The wallet id to query
     * @param string $asset_id The asset id to query
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_external_wallet_asset(string $wallet_id, string $asset_id)
    {
        return $this->apiClient->get_request("/v1/external_wallets/{$wallet_id}/{$asset_id}");
    }

    /**
     * Gets all contract wallets for your tenant
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_contract_wallets()
    {
        return $this->apiClient->get_request("/v1/contracts");
    }

    /**
     * Gets a single contract wallet
     * @param string $wallet_id The contract wallet ID
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_contract_wallet(string $wallet_id)
    {
        return $this->apiClient->get_request("/v1/contracts/{$wallet_id}");
    }

    /**
     * Gets a single contract wallet asset
     * @param string $wallet_id The contract wallet ID
     * @param string $asset_id The asset ID
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_contract_wallet_asset(string $wallet_id, string $asset_id)
    {
        return $this->apiClient->get_request("/v1/contracts/{$wallet_id}/{$asset_id}");
    }

    /**
     * Gets detailed information for a single transaction
     * @param string $txId
     * @return TransactionDetails
     */
    public function get_transaction_by_id(string $txId): TransactionDetails
    {
        $responseData = $this->apiClient->get_request("/v1/transactions/{$txId}");
        return new TransactionDetails(...$responseData->getData());
    }

    /**
     * Gets detailed information for a single transaction
     * @param string $externalTxId
     * @return TransactionDetails
     */
    public function get_transaction_by_external_id(string $externalTxId): TransactionDetails
    {
        $responseData = $this->apiClient->get_request("/v1/transactions/external_tx_id/{$externalTxId}");
        return new TransactionDetails(...$responseData->getData());
    }

    /**
     * Gets the estimated fees for an asset
     * @param string $asset_id The asset symbol (e.g BTC, ETH)
     * @return NetworkFee
     */
    public function get_fee_for_asset(string $asset_id): NetworkFee
    {
        $responseData = $this->apiClient->get_request("/v1/estimate_network_fee", ['assetId' => $asset_id]);
        return new NetworkFee(...$responseData->getData());
    }

    /**
     * @param string $asset_id The asset symbol (e.g BTC, ETH)
     * @param string $amount The transaction source
     * @param TransferPeerPath $source The transfer destination.
     * @param DestinationTransferPeerPath|TransferPeerPath|null $destination The amount
     * @param TransactionEnums|null $tx_type Transaction type: either TransactionEnums::_TRANSFER(), MINT, BURN, TRANSACTION_SUPPLY_TO_COMPOUND or TRANSACTION_REDEEM_FROM_COMPOUND. Default is TransactionEnums::_TRANSFER.
     * @param string|null $idempotency_key
     * @param array|null $destinations (list of TransactionDestination objects, optional) For UTXO based assets, send to multiple destinations which should be specified using this field.
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function estimate_fee_for_transaction(string $asset_id, string $amount, TransferPeerPath $source, DestinationTransferPeerPath $destination = null, TransactionEnums $tx_type = null,
                                                 string $idempotency_key = null, array $destinations = null)
    {
        if (is_null($tx_type)) {
            $tx_type = TransactionEnums::_TRANSFER();
        }

        $body = [
            "assetId" => $asset_id,
            "amount" => $amount,
            "source" => get_object_vars($source),
            "operation" => (string)$tx_type
        ];
        if ($destination) {
            $body["destination"] = get_object_vars($destination);
        }
        if ($destinations) {
            $body['destinations'] = [];
            foreach ($destinations as $item) {
                if (!($item instanceof TransactionDestination)) {
                    throw new FireblocksApiException("Expected destinations of type TransactionDestination");
                }
                $body['destinations'][] = get_object_vars($item);
            }
        }

        return $this->apiClient->post_request("/v1/transactions/estimate_fee", $body, $idempotency_key);
    }

    /**
     * Cancels the selected transaction
     * @param string $txId The transaction id to cancel
     * @param string|null $idempotency_key
     */
    public function cancel_transaction_by_id(string $txId, string $idempotency_key = null)
    {

        return $this->apiClient->post_request("/v1/transactions/{$txId}/cancel", [], $idempotency_key)->getData();
    }

    /**
     * Drops the selected transaction from the blockchain by replacing it with a 0 ETH transaction to itself
     * @param string $txId The transaction id to drop
     * @param FeeLevelEnums|null $fee_level The fee level of the dropping transaction
     * @param string|null $requested_fee Requested fee for transaction
     * @param string|null $idempotency_key
     * @return string|void
     */
    public function drop_transaction(string $txId, FeeLevelEnums $fee_level = null, string $requested_fee = null, string $idempotency_key = null)
    {
        $body = [];

        if ($fee_level)
            $body["feeLevel"] = (string)$fee_level;

        if ($requested_fee)
            $body["requestedFee"] = $requested_fee;

        return $this->apiClient->post_request("/v1/transactions/{$txId}/drop", $body, $idempotency_key)->getData();
    }

    /**
     * Creates a new vault account.
     * @param string $name A name for the new vault account
     * @param bool $hiddenOnUI Specifies whether the vault account is hidden from the web console, false by default
     * @param string|null $customer_ref_id The ID for AML providers to associate the owner of funds with transactions
     * @param bool $autoFuel
     * @param string|null $idempotency_key
     * @return VaultAccount
     */
    public function create_vault_account(string $name, bool $hiddenOnUI = false, string $customer_ref_id = null, bool $autoFuel = false, string $idempotency_key = null): VaultAccount
    {
        $body = [
            "name" => $name,
            "hiddenOnUI" => $hiddenOnUI,
            "autoFuel" => $autoFuel
        ];

        if ($customer_ref_id)
            $body["customerRefId"] = $customer_ref_id;

        $responseData = $this->apiClient->post_request("/v1/vault/accounts", $body, $idempotency_key);
        return new VaultAccount(...$responseData->getData());
    }

    /**
     * Hides the vault account from being visible in the web console
     * @param string $vault_account_id The vault account Id
     * @param $idempotency_key
     * @return array|mixed|null
     */
    public function hide_vault_account(string $vault_account_id, $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/vault/accounts/{$vault_account_id}/hide", [], $idempotency_key)->getData();
    }

    /**
     * Returns the vault account to being visible in the web console
     * @param string $vault_account_id The vault account Id
     * @param string|null $idempotency_key
     * @return string|mixed|null
     */
    public function unhide_vault_account(string $vault_account_id, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/vault/accounts/{$vault_account_id}/unhide", [], $idempotency_key)->getData();
    }

    /**
     * Freezes the selected transaction
     * @param string $txId The transaction ID to freeze
     * @param string|null $idempotency_key
     * @return array|mixed|null
     */
    public function freeze_transaction_by_id(string $txId, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/transactions/{$txId}/freeze", [], $idempotency_key)->getData();
    }

    /**
     * Unfreezes the selected transaction
     * @param string $txId The transaction ID to unfreeze
     * @param string|null $idempotency_key
     * @return array|mixed|null
     */
    public function unfreeze_transaction_by_id(string $txId, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/transactions/{$txId}/unfreeze", [], $idempotency_key)->getData();
    }

    /**
     * Updates a vault account.
     * @param string $vault_account_id The vault account Id
     * @param string $name A new name for the vault account
     * @return array|mixed|null
     */
    public function update_vault_account(string $vault_account_id, string $name)
    {
        return $this->apiClient->put_request("/v1/vault/accounts/{$vault_account_id}", ['name' => $name])->getData();
    }

    /**
     * Creates a new asset within an existing vault account
     * @param string $vault_account_id The vault account Id
     * @param string $asset_id The symbol of the asset to add (e.g BTC, ETH)
     * @param string|null $idempotency_key
     * @return CreateVaultAssetResponse
     */
    public function create_vault_asset(string $vault_account_id, string $asset_id, string $idempotency_key = null): CreateVaultAssetResponse
    {
        $responseData = $this->apiClient->post_request("/v1/vault/accounts/{$vault_account_id}/{$asset_id}", [], $idempotency_key);
        return new CreateVaultAssetResponse(...$responseData->getData());
    }

    /**
     * Retry to create a vault asset for a vault asset that failed
     * @param string $vault_account_id The vault account Id
     * @param string $asset_id The symbol of the asset to add (e.g BTC, ETH)
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function activate_vault_asset(string $vault_account_id, string $asset_id, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/vault/accounts/{$vault_account_id}/{$asset_id}/activate", [], $idempotency_key);
    }

    /**
     * Sets an AML/KYT customer reference ID for the vault account
     * @param string $vault_account_id The vault account Id
     * @param string $customer_ref_id The ID for AML providers to associate the owner of funds with transactions
     * @param string|null $idempotency_key
     * @return array|mixed|null
     */
    public function set_vault_account_customer_ref_id(string $vault_account_id, string $customer_ref_id, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/vault/accounts/{$vault_account_id}/set_customer_ref_id", ["customerRefId" => $customer_ref_id], $idempotency_key)->getData();
    }

    /**
     * Sets an AML/KYT customer reference ID for the given address
     * @param string $vault_account_id The vault account Id
     * @param string $asset_id The symbol of the asset to add (e.g BTC, ETH)
     * @param string $address The address for which to set the customer reference id
     * @param string|null $customer_ref_id The ID for AML providers to associate the owner of funds with transactions
     * @param $idempotency_key
     * @return array|mixed|null
     */
    public function set_customer_ref_id_for_address(string $vault_account_id, string $asset_id, string $address, string $customer_ref_id = null, $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/vault/accounts/{$vault_account_id}/{$asset_id}/addresses/{$address}/set_customer_ref_id", ["customerRefId" => $customer_ref_id ?? ''], $idempotency_key)->getData();
    }

    /**
     * Creates a new contract wallet
     * @param string $name A name for the new contract wallet
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function create_contract_wallet(string $name, string $idempotency_key = null)
    {

        return $this->apiClient->post_request("/v1/contracts", ["name" => $name], $idempotency_key);
    }

    /**
     * Creates a new contract wallet asset
     * @param string $wallet_id The wallet id
     * @param string $assetId The asset to add
     * @param string $address The wallet address
     * @param string|null $tag (for ripple only) The ripple account tag
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function create_contract_wallet_asset(string $wallet_id, string $assetId, string $address, string $tag = null, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/contracts/{$wallet_id}/{$assetId}", ["address" => $address, "tag" => $tag], $idempotency_key);
    }

    /**
     * Creates a new external wallet
     * @param string $name A name for the new external wallet
     * @param string|null $customer_ref_id The ID for AML providers to associate the owner of funds with transactions
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function create_external_wallet(string $name, string $customer_ref_id = null, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/external_wallets", ["name" => $name, "customerRefId" => $customer_ref_id ?? ''], $idempotency_key);
    }

    /**
     * Creates a new internal wallet
     * @param string $name A name for the new internal wallet
     * @param string|null $customer_ref_id The ID for AML providers to associate the owner of funds with transactions
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function create_internal_wallet(string $name, string $customer_ref_id = null, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/internal_wallets", ["name" => $name, "customerRefId" => $customer_ref_id ?? ''], $idempotency_key);
    }

    /**
     *Creates a new asset within an exiting external wallet
     * @param string $wallet_id The wallet id
     * @param string $asset_id The symbol of the asset to add (e.g BTC, ETH)
     * @param string $address The wallet address
     * @param string|null $tag (for ripple only) The ripple account tag
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function create_external_wallet_asset(string $wallet_id, string $asset_id, string $address, string $tag = null, string $idempotency_key = null)
    {
        $body = [
            "address" => $address
        ];
        if ($tag)
            $body["tag"] = $tag;

        return $this->apiClient->post_request("/v1/external_wallets/{$wallet_id}/{$asset_id}", $body, $idempotency_key);
    }

    /**
     * Creates a new asset within an exiting internal wallet
     * @param string $wallet_id The wallet id
     * @param string $asset_id The symbol of the asset to add (e.g BTC, ETH)
     * @param string $address The wallet address
     * @param string|null $tag (for ripple only) The ripple account tag
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function create_internal_wallet_asset(string $wallet_id, string $asset_id, string $address, string $tag = null, string $idempotency_key = null)
    {

        $body = [
            "address" => $address
        ];
        if ($tag)
            $body["tag"] = $tag;

        return $this->apiClient->post_request("/v1/internal_wallets/{$wallet_id}/{$asset_id}", $body, $idempotency_key);
    }

    /**
     * Deletes a single contract wallet
     * @param string $wallet_id The contract wallet ID
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function delete_contract_wallet(string $wallet_id)
    {
        return $this->apiClient->delete_request("/v1/contracts/{$wallet_id}");
    }

    /**
     * Deletes a single contract wallet
     * @param string $wallet_id The contract wallet ID
     * @param string $asset_id The asset ID
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function delete_contract_wallet_asset(string $wallet_id, string $asset_id)
    {
        return $this->apiClient->delete_request("/v1/contracts/{$wallet_id}/{$asset_id}");
    }

    /**
     * Deletes a single internal wallet
     * @param string $wallet_id The internal wallet ID
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function delete_internal_wallet(string $wallet_id)
    {
        return $this->apiClient->delete_request("/v1/internal_wallets/{$wallet_id}");
    }

    /**
     * Deletes a single external wallet
     * @param string $wallet_id The external wallet ID
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function delete_external_wallet(string $wallet_id)
    {
        return $this->apiClient->delete_request("/v1/external_wallets/{$wallet_id}");
    }

    /**
     * Deletes a single asset from an internal wallet
     * @param string $wallet_id The internal wallet ID
     * @param string $asset_id The asset ID
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function delete_internal_wallet_asset(string $wallet_id, string $asset_id)
    {
        return $this->apiClient->delete_request("/v1/internal_wallets/{$wallet_id}/{$asset_id}");
    }

    /**
     * Deletes a single asset from an external wallet
     * @param string $wallet_id The external wallet ID
     * @param string $asset_id The asset ID
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function delete_external_wallet_asset(string $wallet_id, string $asset_id)
    {
        return $this->apiClient->delete_request("/v1/external_wallets/{$wallet_id}/{$asset_id}");
    }

    /**
     * Sets an AML/KYT customer reference ID for the specific internal wallet
     * @param string $wallet_id The external wallet ID
     * @param string|null $customer_ref_id The ID for AML providers to associate the owner of funds with transactions
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function set_customer_ref_id_for_internal_wallet(string $wallet_id, string $customer_ref_id = null, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/internal_wallets/{$wallet_id}/set_customer_ref_id", ["customerRefId" => $customer_ref_id ?? ''], $idempotency_key);
    }

    /**
     * Sets an AML/KYT customer reference ID for the specific external wallet
     * @param string $wallet_id The external wallet ID
     * @param string|null $customer_ref_id The ID for AML providers to associate the owner of funds with transactions
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function set_customer_ref_id_for_external_wallet(string $wallet_id, string $customer_ref_id = null, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/external_wallets/{$wallet_id}/set_customer_ref_id", ["customerRefId" => $customer_ref_id ?? ''], $idempotency_key);
    }

    /**
     * Gets all transfer tickets of your tenant
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_transfer_tickets()
    {
        return $this->apiClient->get_request("/v1/transfer_tickets");
    }

    /**
     * Creates a new transfer ticket
     * @param array $terms (list of TransferTicketTerm objects): The list of TransferTicketTerm
     * @param string|null $external_ticket_id The ID for of the transfer ticket on customer's platform
     * @param string|null $description A description for the new ticket
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function create_transfer_ticket(array $terms, string $external_ticket_id = null, string $description = null, string $idempotency_key = null)
    {
        $body = [];

        if ($external_ticket_id)
            $body["externalTicketId"] = $external_ticket_id;

        if ($description)
            $body["description"] = $description;


        $body['terms'] = [];
        foreach ($terms as $item) {
            if (!($item instanceof TransferTicketTerm)) {
                throw new FireblocksApiException("Expected Transfer Assist ticket's term of type TransferTicketTerm");
            }
            $body['destinations'][] = get_object_vars($item);
        }

        return $this->apiClient->post_request("/v1/transfer_tickets", $body, $idempotency_key);
    }

    /**
     * Retrieve a transfer ticket
     * @param string $ticket_id The ID of the transfer ticket.
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_transfer_ticket_by_id(string $ticket_id)
    {
        return $this->apiClient->get_request("/v1/transfer_tickets/{$ticket_id}");
    }

    /**
     * Retrieve a transfer ticket
     * @param string $ticket_id The ID of the transfer ticket
     * @param string $term_id The ID of the term within the transfer ticket
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_transfer_ticket_term(string $ticket_id, string $term_id)
    {
        return $this->apiClient->get_request("/v1/transfer_tickets/{$ticket_id}/{$term_id}");
    }

    /**
     * Cancel a transfer ticket
     * @param string $ticket_id The ID of the transfer ticket to cancel
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function cancel_transfer_ticket(string $ticket_id, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/transfer_tickets/{$ticket_id}/cancel", [], $idempotency_key);
    }

    /**
     * Initiate a transfer ticket transaction
     * @param string $ticket_id The ID of the transfer ticket
     * @param string $term_id The ID of the term within the transfer ticket
     * @param TransferPeerPath|null $source JSON object of the source of the transaction. The network connection's vault account by default
     * @param $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function execute_ticket_term(string $ticket_id, string $term_id, TransferPeerPath $source = null, $idempotency_key = null)
    {
        $body = [];

        if ($source)
            $body["source"] = get_object_vars($source);

        return $this->apiClient->post_request("/v1/transfer_tickets/{$ticket_id}/{$term_id}/transfer", $body, $idempotency_key);
    }

    /**
     * Set the required number of confirmations for transaction
     * @param string $txId The transaction id
     * @param int|float|string $required_confirmations_number Required confirmation threshold fot the txid
     * @param string|null $idempotency_key
     * @return SetConfirmationsThresholdResponse
     */
    public function set_confirmation_threshold_for_txid(string $txId, string $required_confirmations_number, string $idempotency_key = null): SetConfirmationsThresholdResponse
    {
        $body = [
            "numOfConfirmations" => $required_confirmations_number
        ];

        $responseData = $this->apiClient->post_request("/v1/transactions/{$txId}/set_confirmation_threshold", $body, $idempotency_key);
        return new SetConfirmationsThresholdResponse(...$responseData->getData());
    }

    /**
     * Set the required number of confirmations for transaction by txhash
     * @param string $txHash The transaction hash
     * @param int|float|string $required_confirmations_number Required confirmation threshold fot the txhash
     * @param string|null $idempotency_key
     * @return SetConfirmationsThresholdResponse
     */
    public function set_confirmation_threshold_for_txhash(string $txHash, string $required_confirmations_number, string $idempotency_key = null): SetConfirmationsThresholdResponse
    {
        $body = [
            "numOfConfirmations" => $required_confirmations_number
        ];

        $responseData = $this->apiClient->post_request("/v1/txHash/{$txHash}/set_confirmation_threshold", $body, $idempotency_key);
        return new SetConfirmationsThresholdResponse(...$responseData->getData());
    }

    /**
     * Retrieves the public key of your Fireblocks' Vault.
     * @param SigningAlgorithmEnums $algorithm String, one of the supported SigningAlgorithms.
     * @param array $derivation_path List of integers. [44,0,0,0,0]
     * @param bool|null $compressed Boolean, whether the returned key should be in compressed format or not, false by default.
     * @return PublicKey
     */
    public function get_public_key_info(SigningAlgorithmEnums $algorithm, array $derivation_path, bool $compressed = null): PublicKey
    {
        $params = [
            'algorithm' => (string)$algorithm
        ];

        if ($derivation_path)
            $params['derivationPath'] = json_encode($derivation_path);
        if ($compressed)
            $params['compressed'] = $compressed;

        $responseData = $this->apiClient->get_request("/v1/vault/public_key_info", $params);
        return new PublicKey(...$responseData->getData());
    }

    /**
     * Get the public key information for a vault account
     * @param string $asset_id The ID of the asset.
     * @param int|float|string $vault_account_id The ID of the vault account which address should be retrieved, or 'default' for the default vault account.
     * @param int|float|string $change Whether the address should be derived internal (change) or not.
     * @param int|float|string $address_index The index of the address for the derivation path.
     * @param bool|null $compressed Boolean, whether the returned key should be in compressed format or not, false by default.
     * @return PublicKey
     */
    public function get_public_key_info_for_vault_account(string $asset_id, string $vault_account_id, string $change, string $address_index, bool $compressed = null): PublicKey
    {
        $params = [];

        if ($compressed)
            $params['compressed'] = $compressed;

        $responseData = $this->apiClient->get_request("/v1/vault/accounts/{$vault_account_id}/{$asset_id}/{$change}/{$address_index}/public_key_info", $params);
        return new PublicKey(...$responseData->getData());
    }

    /**
     * Allocate funds from your default balance to a private ledger
     * @param string $vault_account_id
     * @param string $asset
     * @param string $allocation_id
     * @param string $amount
     * @param bool|null $treat_as_gross_amount
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function allocate_funds_to_private_ledger(string $vault_account_id, string $asset, string $allocation_id, string $amount, bool $treat_as_gross_amount = null, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/vault/accounts/{$vault_account_id}/{$asset}/lock_allocation", ["allocationId" => $allocation_id, "amount" => $amount, "treatAsGrossAmount" => $treat_as_gross_amount ?? false], $idempotency_key);
    }

    /**
     * deallocate funds from a private ledger to your default balance
     * @param string $vault_account_id
     * @param string $asset
     * @param string $allocation_id
     * @param string $amount
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function deallocate_funds_from_private_ledger(string $vault_account_id, string $asset, string $allocation_id, string $amount, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/vault/accounts/{$vault_account_id}/{$asset}/release_allocation", ["allocationId" => $allocation_id, "amount" => $amount], $idempotency_key);
    }

    /**
     * Get configuration and status of the Gas Station account
     * @param string|null $asset_id
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_gas_station_info(string $asset_id = null)
    {
        $url = "/v1/gas_station";

        if ($asset_id)
            $url .= "/{$asset_id}";

        return $this->apiClient->get_request($url);
    }

    /**
     * Set configuration of the Gas Station account
     * @param string $gas_threshold Below this ETH balance the address will be funded up until gasCap value, in ETH units.
     * @param string $gas_cap Up to this level the address will be funded with ETH, in ETH units.
     * @param string|null $max_gas_price The funding transaction will be sent with this maximum value gas price, in Gwei units.
     * @param string|null $asset_id
     * @return Types\Response\Base\ResponseData
     */
    public function set_gas_station_configuration(string $gas_threshold, string $gas_cap, string $max_gas_price = null, string $asset_id = null)
    {
        $url = "/v1/gas_station/configuration";

        if ($asset_id)
            $url .= "/{$asset_id}";

        $body = [
            "gasThreshold" => $gas_threshold,
            "gasCap" => $gas_cap,
            "maxGasPrice" => $max_gas_price
        ];

        return $this->apiClient->put_request($url, $body);
    }

    /**
     * Gets vault assets accumulated balance
     * @param string|null $account_name_prefix Vault account name prefix
     * @param string|null $account_name_suffix Vault account name suffix
     * @return VaultAssetList
     */
    public function get_vault_assets_balance(string $account_name_prefix = null, string $account_name_suffix = null): VaultAssetList
    {
        $params = [];

        if ($account_name_prefix)
            $params['accountNamePrefix'] = $account_name_prefix;

        if ($account_name_suffix)
            $params['accountNameSuffix'] = $account_name_suffix;

        $responseData = $this->apiClient->get_request("/v1/vault/assets", $params);
        return new VaultAssetList($responseData->getData());
    }

    /**
     * Gets vault accumulated balance by asset
     * @param string|null $asset_id The asset symbol (e.g BTC, ETH)
     * @return VaultAsset
     */
    public function get_vault_balance_by_asset(string $asset_id = null): VaultAsset
    {
        $url = "/v1/vault/assets";

        if ($asset_id)
            $url .= "/{$asset_id}";

        $responseData = $this->apiClient->get_request($url);
        return new VaultAsset(...$responseData->getData());
    }

    /**
     * Creates a new raw transaction with the specified parameters
     * @param CreateRawTransactionParameters $createRawTransactionParameters
     * @return CreateTransactionResponse
     * @throws FireblocksApiException
     */
    public function create_raw_transaction(CreateRawTransactionParameters $createRawTransactionParameters, ?string $idempotency_key = null): CreateTransactionResponse
    {
        if (is_null($createRawTransactionParameters->getAssetId()) && is_null($createRawTransactionParameters->getRawMessageData()->algorithm)) {
            throw new FireblocksApiException("Got invalid signing algorithm type: {$createRawTransactionParameters->getRawMessageData()->algorithm}");
        }

        $responseData = $this->apiClient->post_request("/v1/transactions", $createRawTransactionParameters->toArray(), $idempotency_key);
        return new CreateTransactionResponse(...$responseData->getData());
    }

    /**
     * @param CreateTransactionParameters $createTransactionParameters
     * @param string|null $idempotency_key
     * @return CreateTransactionResponse
     */
    public function create_transaction(CreateTransactionParameters $createTransactionParameters, ?string $idempotency_key = null): CreateTransactionResponse
    {

        $responseData = $this->apiClient->post_request("/v1/transactions", $createTransactionParameters->toArray(), $idempotency_key);
        return new CreateTransactionResponse(...$responseData->getData());
    }


    /**
     * Sets autoFuel to true/false for a vault account
     * @param string $vault_account_id The vault account Id
     * @param bool $auto_fuel The new value for the autoFuel flag
     * @param string|null $idempotency_key
     * @return array|mixed|null
     */
    public function setAutoFuel(string $vault_account_id, bool $auto_fuel, string $idempotency_key = null)
    {
        $body = [
            "autoFuel" => $auto_fuel
        ];

        return $this->apiClient->post_request("/v1/vault/accounts/{$vault_account_id}/set_auto_fuel", $body, $idempotency_key)->getData();
    }

    /**
     * Resend webhooks of transaction
     * @param string $tx_id The transaction for which the message is sent.
     * @param bool $resend_created If true, a webhook will be sent for the creation of the transaction.
     * @param bool $resend_status_updated If true, a webhook will be sent for the status of the transaction.
     * @return Types\Response\Base\ResponseData
     */
    public function resend_transaction_webhooks_by_id(string $tx_id, bool $resend_created, bool $resend_status_updated)
    {
        $body = [
            "resendCreated" => $resend_created,
            "resendStatusUpdated" => $resend_status_updated
        ];

        return $this->apiClient->post_request("/v1/webhooks/resend/{$tx_id}", $body);
    }

    /**
     * Get max spendable amount per asset and vault.
     * @param string $vault_account_id The vault account Id.
     * @param string $asset_id Asset id.
     * @param bool $manual_signing False by default.
     * @return array|mixed|null
     */
    public function get_max_spendable_amount(string $vault_account_id, string $asset_id, bool $manual_signing = false)
    {
        return $this->apiClient->get_request("/v1/vault/accounts/{$vault_account_id}/{$asset_id}/max_spendable_amount?manual_signing={manual_signing}")->getData();
    }

    /**
     * Gets vault accumulated balance by asset
     * @param string $asset_id The asset symbol (e.g XRP, EOS) Supported for the following assets: XRP, DOT, XLM, EOS.
     * @param string $address The address to be verified
     * @return AddressStatus
     */
    public function validate_address(string $asset_id, string $address): AddressStatus
    {
        $responseData = $this->apiClient->get_request("/v1/transactions/validate_address/{$asset_id}/{$address}");
        return new AddressStatus(...$responseData->getData());
    }

    /**
     * Resend failed webhooks of your tenant
     * @return Types\Response\Base\ResponseData
     */
    public function resend_webhooks()
    {
        return $this->apiClient->post_request("/v1/webhooks/resend");
    }

    /**
     * Gets all users of your tenant
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_users()
    {
        return $this->apiClient->get_request("/v1/users");
    }

    /**
     * Get your connected off exchanges virtual accounts
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_off_exchanges()
    {
        return $this->apiClient->get_request("/v1/off_exchange_accounts");
    }

    /**
     * Get your connected off exchange by it's ID
     * @param string $off_exchange_id ID of the off exchange virtual account
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_off_exchange_by_id(string $off_exchange_id)
    {
        return $this->apiClient->get_request("/v1/off_exchange_accounts/{$off_exchange_id}");
    }

    /**
     * Create a settle request to your off exchange by it's ID
     * @param string $off_exchange_id ID of the off exchange virtual account
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function settle_off_exchange_by_id(string $off_exchange_id, string $idempotency_key = null)
    {
        return $this->apiClient->post_request("/v1/off_exchanges/{$off_exchange_id}/settle", [], $idempotency_key);
    }

    /**
     * Setting fee payer configuration for base asset
     * @param string $base_asset ID of the base asset you want to configure fee payer for (for example: SOL)
     * @param string $fee_payer_account_id ID of the vault account you want your fee to be paid from
     * @param string|null $idempotency_key
     * @return Types\Response\Base\ResponseData
     */
    public function set_fee_payer_configuration(string $base_asset, string $fee_payer_account_id, string $idempotency_key = null)
    {
        $body = [
            "feePayerAccountId" => $fee_payer_account_id
        ];

        return $this->apiClient->post_request("/v1/fee_payer/{$base_asset}", $body, $idempotency_key);
    }

    /**
     * Get fee payer configuration for base asset
     * @param string $base_asset ID of the base asset
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function get_fee_payer_configuration(string $base_asset)
    {
        return $this->apiClient->get_request("/v1/fee_payer/{$base_asset}");
    }

    /**
     * Delete fee payer configuration for base asset
     * @param string $base_asset ID of the base asset
     * @return Types\Response\Base\ResponseData
     * @throws FireblocksApiException
     */
    public function remove_fee_payer_configuration(string $base_asset)
    {
        return $this->apiClient->delete_request("/v1/fee_payer/{$base_asset}");
    }
}