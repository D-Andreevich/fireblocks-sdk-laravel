<?php

namespace FireblocksSdkLaravel\Types;

class AmlScreeningResult
{
    private string $provider; //		The AML service provider.
    private string $payload;  //		The response of the AML service provider.

    public function __construct(string $provider, string $payload)
    {
        $this->provider = $provider;
        $this->payload  = $payload;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @return string
     */
    public function getPayload(): string
    {
        return $this->payload;
    }


}