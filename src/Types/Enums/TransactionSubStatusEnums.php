<?php

namespace FireblocksSdkLaravel\Types\Enums;

class TransactionSubStatusEnums extends EnumCustom
{
    const _INSUFFICIENT_FUNDS                 = 'INSUFFICIENT_FUNDS';                 // - Not enough funds to fulfill the withdraw request
    const _AMOUNT_TOO_SMALL                   = 'AMOUNT_TOO_SMALL';                   // - Attempt to withdraw an amount below the allowed minimum
    const _UNSUPPORTED_ASSET                  = 'UNSUPPORTED_ASSET';                  // - Asset is not supported
    const _UNAUTHORISED__MISSING_PERMISSION   = 'UNAUTHORISED__MISSING_PERMISSION';   // - Third party (e.g. exchange) API missing permission
    const _INVALID_SIGNATURE                  = 'INVALID_SIGNATURE';                  // - Invalid transaction signature
    const _API_INVALID_SIGNATURE              = 'API_INVALID_SIGNATURE';              // - Third party (e.g. exchange) API call invalid signature
    const _UNAUTHORISED__MISSING_CREDENTIALS  = 'UNAUTHORISED__MISSING_CREDENTIALS';  // - Missing third party (e.g. exchange) credentials
    const _UNAUTHORISED__USER                 = 'UNAUTHORISED__USER';                 // - Attempt to initiate or approve a transaction by an unauthorised user
    const _UNAUTHORISED__DEVICE               = 'UNAUTHORISED__DEVICE';               // - Unauthorised user's device
    const _INVALID_UNMANAGED_WALLET           = 'INVALID_UNMANAGED_WALLET';           // - Unmanaged wallet is disabled or does not exist
    const _INVALID_EXCHANGE_ACCOUNT           = 'INVALID_EXCHANGE_ACCOUNT';           // - Exchange account is disabled or does not exist
    const _INSUFFICIENT_FUNDS_FOR_FEE         = 'INSUFFICIENT_FUNDS_FOR_FEE';         // - Not enough balance to fund the requested transaction
    const _INVALID_ADDRESS                    = 'INVALID_ADDRESS';                    // - Unsupported address format
    const _WITHDRAW_LIMIT                     = 'WITHDRAW_LIMIT';                     // - Transaction exceeds the exchange's withdraw limit
    const _API_CALL_LIMIT                     = 'API_CALL_LIMIT';                     // - Exceeded third party (e.g. exchange) API call limit
    const _ADDRESS_NOT_WHITELISTED            = 'ADDRESS_NOT_WHITELISTED';            // - Attempt to withdraw from an exchange to a non-whitelisted address
    const _TIMEOUT                            = 'TIMEOUT';                            // - The transaction request has timed out
    const _CONNECTIVITY_ERROR                 = 'CONNECTIVITY_ERROR';                 // - Network error
    const _THIRD_PARTY_INTERNAL_ERROR         = 'THIRD_PARTY_INTERNAL_ERROR';         // - Received an internal error response from a third party service
    const _CANCELLED_EXTERNALLY               = 'CANCELLED_EXTERNALLY';               // - Transaction was canceled by a third party service
    const _INVALID_THIRD_PARTY_RESPONSE       = 'INVALID_THIRD_PARTY_RESPONSE';       // - Unrecognized third party response
    const _VAULT_WALLET_NOT_READY             = 'VAULT_WALLET_NOT_READY';             // - Vault wallet is not ready
    const _MISSING_DEPOSIT_ADDRESS            = 'MISSING_DEPOSIT_ADDRESS';            // - Could not retrieve a deposit address from the exchange
    const _ONE_TIME_ADDRESS_DISABLED          = 'ONE_TIME_ADDRESS_DISABLED';          // - Transferring to non-whitelisted addresses is disabled in your workspace.
    const _INTERNAL_ERROR                     = 'INTERNAL_ERROR';                     // - Internal error while processing the transaction
    const _UNKNOWN_ERROR                      = 'UNKNOWN_ERROR';                      // - Unexpected error
    const _AUTHORIZER_NOT_FOUND               = 'AUTHORIZER_NOT_FOUND';               // - No authorizer found to approve the operation or the only authorizer found is the initiator
    const _INSUFFICIENT_RESERVED_FUNDING      = 'INSUFFICIENT_RESERVED_FUNDING';      // - Some assets require a minimum of reserved funds being kept on the account
    const _MANUAL_DEPOSIT_ADDRESS_REQUIRED    = 'MANUAL_DEPOSIT_ADDRESS_REQUIRED';    // - Error while retrieving a deposit address from an exchange. Please generate a deposit address for your exchange account
    const _INVALID_FEE                        = 'INVALID_FEE';                        // - Transaction fee is not in the allowed range
    const _ERROR_UNSUPPORTED_TRANSACTION_TYPE = 'ERROR_UNSUPPORTED_TRANSACTION_TYPE'; // - Attempt to execute an unsupported transaction Type
    const _UNSUPPORTED_OPERATION              = 'UNSUPPORTED_OPERATION';              // - Unsupported operation
    const _3RD_PARTY_PROCESSING               = '3RD_PARTY_PROCESSING';               // - The transaction is pending approval by the 3rd party service (e.g. exchange)
    const _PENDING_BLOCKCHAIN_CONFIRMATIONS   = 'PENDING_BLOCKCHAIN_CONFIRMATIONS';   // - Pending Blockchain confirmations
    const _3RD_PARTY_CONFIRMING               = '3RD_PARTY_CONFIRMING';               // - Pending confirmation on the exchange
    const _CONFIRMED                          = 'CONFIRMED';                          // - Confirmed on the blockchain
    const _3RD_PARTY_COMPLETED                = '3RD_PARTY_COMPLETED';                // - Completed on the 3rd party service (e.g. exchange)
    const _REJECTED_BY_USER                   = 'REJECTED_BY_USER';                   // - The transaction was rejected by one of the signers
    const _CANCELLED_BY_USER                  = 'CANCELLED_BY_USER';                  // - The transaction was canceled via the Console or the API
    const _3RD_PARTY_CANCELLED                = '3RD_PARTY_CANCELLED';                // - Cancelled on the exchange
    const _3RD_PARTY_REJECTED                 = '3RD_PARTY_REJECTED';                 // - Rejected or not approved in time by user
    const _REJECTED_AML_SCREENING             = 'REJECTED_AML_SCREENING';             // - Rejected on AML Screening
    const _BLOCKED_BY_POLICY                  = 'BLOCKED_BY_POLICY';                  // - Transaction is blocked due to a policy rule
    const _FAILED_AML_SCREENING               = 'FAILED_AML_SCREENING';               // - AML screening failed
    const _PARTIALLY_FAILED                   = 'PARTIALLY_FAILED';                   // - Only for Aggregated transactions. One or more of the associated transaction records failed
    const _3RD_PARTY_FAILED                   = '3RD_PARTY_FAILED';                   // - Transaction failed at the exchange
    const _DROPPED_BY_BLOCKCHAIN              = 'DROPPED_BY_BLOCKCHAIN';              // - The transaction was replaced by another transaction with higher fee
    const _REJECTED_BY_BLOCKCHAIN             = 'REJECTED_BY_BLOCKCHAIN';             // - Transaction was rejected by the Blockchain due to too low fees, bad inputs or bad nonce
    const _INVALID_FEE_PARAMS                 = 'INVALID_FEE_PARAMS';                 // - Fee parameters are inconsistent or unknown.
    const _MISSING_TAG_OR_MEMO                = 'MISSING_TAG_OR_MEMO';                // - A tag or memo is required to send funds to a third party address, including all exchanges.
    const _SIGNING_ERROR                      = 'SIGNING_ERROR';                      // - The transaction signing failed, resubmit the transaction to sign again.
    const _GAS_LIMIT_TOO_LOW                  = 'GAS_LIMIT_TOO_LOW';                  // - The transaction was rejected because the gas limit was set too low
    const _TOO_MANY_INPUTS                    = 'TOO_MANY_INPUTS';                    // - The transaction includes more inputs than the allowed limit (only for UTXO based blockchains)
    const _MAX_FEE_EXCEEDED                   = 'MAX_FEE_EXCEEDED';                   // - Gas price is currently above selected max fee
    const _ACTUAL_FEE_TOO_HIGH                = 'ACTUAL_FEE_TOO_HIGH';                // - Chosen fee is below current price
    const _INVALID_CONTRACT_CALL_DATA         = 'INVALID_CONTRACT_CALL_DATA';         // - Transaction data was not encoded properly
    const _INVALID_NONCE_TOO_LOW              = 'INVALID_NONCE_TOO_LOW';              // - Illegal nonce
    const _INVALID_NONCE_TOO_HIGH             = 'INVALID_NONCE_TOO_HIGH';             // - Illegal nonce
    const _INVALID_NONCE_FOR_RBF              = 'INVALID_NONCE_FOR_RBF';              // - No matching nonce
    const _FAIL_ON_LOW_FEE                    = 'FAIL_ON_LOW_FEE';                    // - Current blockchain fee is higher than selected
    const _TOO_LONG_MEMPOOL_CHAIN             = 'TOO_LONG_MEMPOOL_CHAIN';             // - Too many unconfirmed transactions from this address
    const _TX_OUTDATED                        = 'TX_OUTDATED';                        // - Nonce already used
    const _INCOMPLETE_USER_SETUP              = 'INCOMPLETE_USER_SETUP';              // - MPC setup was not completed
    const _SIGNER_NOT_FOUND                   = 'SIGNER_NOT_FOUND';                   // - Signer not found
    const _INVALID_TAG_OR_MEMO                = 'INVALID_TAG_OR_MEMO';                // - Invalid Tag or Memo
    const _ZERO_BALANCE_IN_PERMANENT_ADDRESS  = 'ZERO_BALANCE_IN_PERMANENT_ADDRESS';  // - Not enough BTC on legacy permanent address
    const _NEED_MORE_TO_CREATE_DESTINATION    = 'NEED_MORE_TO_CREATE_DESTINATION';    // - Insufficient funds for creating destination account
    const _NON_EXISTING_ACCOUNT_NAME          = 'NON_EXISTING_ACCOUNT_NAME';          // - Account does not exist
    const _ENV_UNSUPPORTED_ASSET              = 'ENV_UNSUPPORTED_ASSET';              // - Asset is not supported under this workspace settings
}