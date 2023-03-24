<?php

namespace FireblocksSdkLaravel\Types;

class DestinationsResponse
{
    private string                   $amount;                        //	The amount to be sent to this destination.
    private TransferPeerPathResponse $destination;                   //	Destination of the transaction.
    private ?float                   $amountUSD;                     //	The USD value of the requested amount.
    private string                   $destinationAddress;            //	Address where the asset were transferred.
    private ?string                  $destinationAddressDescription; //	Description of the address.
    private ?AmlScreeningResult      $amlScreeningResult;            //	The result of the AML screening.
    private ?string                  $customerRefId;                 //	The ID for AML providers to associate the owner of funds with transactions.

    /**
     * @param string $amount
     * @param array $destination
     * @param float|null $amountUSD
     * @param string $destinationAddress
     * @param string|null $destinationAddressDescription
     * @param array|null $amlScreeningResult
     * @param string|null $customerRefId
     */
    public function __construct(string $amount, array $destination, string $destinationAddress, ?array $amlScreeningResult, ?float $amountUSD= null, ?string $destinationAddressDescription= null, ?string $customerRefId = null)
    {
        $this->amount                        = $amount;
        $this->destination                   = new TransferPeerPathResponse(...$destination);
        $this->amountUSD                     = $amountUSD;
        $this->destinationAddress            = $destinationAddress;
        $this->destinationAddressDescription = $destinationAddressDescription;
        $this->amlScreeningResult            = $amlScreeningResult ? new AmlScreeningResult(...$amlScreeningResult) : null;
        $this->customerRefId                 = $customerRefId;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return TransferPeerPathResponse
     */
    public function getDestination(): TransferPeerPathResponse
    {
        return $this->destination;
    }

    /**
     * @return float|null
     */
    public function getAmountUSD(): ?float
    {
        return $this->amountUSD;
    }

    /**
     * @return string
     */
    public function getDestinationAddress(): string
    {
        return $this->destinationAddress;
    }

    /**
     * @return string|null
     */
    public function getDestinationAddressDescription(): ?string
    {
        return $this->destinationAddressDescription;
    }

    /**
     * @return AmlScreeningResult|null
     */
    public function getAmlScreeningResult(): ?AmlScreeningResult
    {
        return $this->amlScreeningResult;
    }

    /**
     * @return string|null
     */
    public function getCustomerRefId(): ?string
    {
        return $this->customerRefId;
    }

}