<?php

namespace FireblocksSdkLaravel\Types;

class Channel
{
    private string $networkId; //	8 characters ID of the channel.
    private string $name;      //	The name of the channel.

    public function __construct(string $networkId, string $name)
    {
        $this->networkId = $networkId;
        $this->name      = $name;
    }

    /**
     * @return string
     */
    public function getNetworkId(): string
    {
        return $this->networkId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}
