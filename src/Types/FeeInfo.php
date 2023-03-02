<?php

namespace FireblocksSdkLaravel\Types;

class FeeInfo
{
    private ?string $networkFee;    //	The fee paid to the network.
    private ?string $serviceFee;    //	The total fee deducted by the exchange from the actual requested amount (serviceFee = amount - netAmount).
    private ?string $gasPrice;

    /**
     * @param string|null $networkFee
     * @param string|null $serviceFee
     * @param string|null $gasPrice
     */
    public function __construct(?string $networkFee = null, ?string $gasPrice = null, ?string $serviceFee = null)
    {
        $this->networkFee = $networkFee;
        $this->serviceFee = $serviceFee;
        $this->gasPrice   = $gasPrice;
    }

    /**
     * @return string|null
     */
    public function getGasPrice(): ?string
    {
        return $this->gasPrice;
    }

    /**
     * @return string|null
     */
    public function getNetworkFee(): ?string
    {
        return $this->networkFee;
    }

    /**
     * @return string|null
     */
    public function getServiceFee(): ?string
    {
        return $this->serviceFee;
    }


}