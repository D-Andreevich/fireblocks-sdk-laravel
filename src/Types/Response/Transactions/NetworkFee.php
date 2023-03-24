<?php

namespace FireblocksSdkLaravel\Types\Response\Transactions;

class NetworkFee
{
    private ?string $feePerByte;	//	[optional] For UTXOs.
    private ?string $gasPrice;	//	[optional] For Ethereum assets (ETH and Tokens).
    private ?string $networkFee;	//	[optional] All other assets.
    private ?string $baseFee;	//	[optional] Base Fee according to EIP-1559 (ETH assets).
    private ?string $priorityFee;	//	[optional] Priority Fee according to EIP-1559 (ETH assets).

    /**
     * @param string|null $feePerByte
     * @param string|null $gasPrice
     * @param string|null $networkFee
     * @param string|null $baseFee
     * @param string|null $priorityFee
     */
    public function __construct(?string $feePerByte = null, ?string $gasPrice = null, ?string $networkFee = null, ?string $baseFee = null, ?string $priorityFee = null)
    {
        $this->feePerByte = $feePerByte;
        $this->gasPrice = $gasPrice;
        $this->networkFee = $networkFee;
        $this->baseFee = $baseFee;
        $this->priorityFee = $priorityFee;
    }

    /**
     * @return string|null
     */
    public function getFeePerByte(): ?string
    {
        return $this->feePerByte;
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
    public function getBaseFee(): ?string
    {
        return $this->baseFee;
    }

    /**
     * @return string|null
     */
    public function getPriorityFee(): ?string
    {
        return $this->priorityFee;
    }
}