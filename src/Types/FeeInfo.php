<?php

namespace FireblocksSdkLaravel\Types;

class FeeInfo
{
    private string $networkFee;    //	The fee paid to the network.
    private string $serviceFee;    //	The total fee deducted by the exchange from the actual requested amount (serviceFee = amount - netAmount).

    public function __construct(string $networkFee, string $serviceFee)
    {
        $this->networkFee = $networkFee;
        $this->serviceFee = $serviceFee;
    }

    /**
     * @return string
     */
    public function getNetworkFee(): string
    {
        return $this->networkFee;
    }

    /**
     * @return string
     */
    public function getServiceFee(): string
    {
        return $this->serviceFee;
    }


}