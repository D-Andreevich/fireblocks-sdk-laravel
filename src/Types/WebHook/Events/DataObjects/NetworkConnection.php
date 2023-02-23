<?php

namespace FireblocksSdkLaravel\Types\WebHook\Events\DataObjects;

use FireblocksSdkLaravel\Types\Channel;
use FireblocksSdkLaravel\Types\WebHook\Events\EventData;

class NetworkConnection implements EventData
{
    private string $id;            //	string	The ID of the Network Connection.
    private Channel $localChannel;  //	Channel	Local channel ID.
    private Channel $remoteChannel; //	Channel	Remote channel ID.

    public function __construct(string $id, array $localChannel,array $remoteChannel)
    {
        $this->id            = $id;
        $this->localChannel  = new Channel(...$localChannel);
        $this->remoteChannel = new Channel(...$remoteChannel);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Channel
     */
    public function getLocalChannel(): Channel
    {
        return $this->localChannel;
    }

    /**
     * @return Channel
     */
    public function getRemoteChannel(): Channel
    {
        return $this->remoteChannel;
    }


}