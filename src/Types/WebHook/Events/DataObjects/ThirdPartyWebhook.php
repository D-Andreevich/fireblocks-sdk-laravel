<?php
namespace FireblocksSdkLaravel\Types\WebHook\Events\DataObjects;

use FireblocksSdkLaravel\Types\WebHook\Events\EventData;

class ThirdPartyWebhook implements EventData
{
    private string $id; //	Id of the thirdparty account on the Fireblocks platform.
    private string $subType; //	The specific exchange, fiat account or unmanaged wallet (either INTERNAL / EXTERNAL).
    private string $name; //	Account name.

    public function __construct(string $id, string $subType, string $name)
    {
        $this->id      = $id;
        $this->subType = $subType;
        $this->name    = $name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSubType(): string
    {
        return $this->subType;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


}