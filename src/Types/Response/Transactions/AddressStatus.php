<?php

namespace FireblocksSdkLaravel\Types\Response\Transactions;

class AddressStatus
{
    private bool $isValid; //	Returns "false" if the address is in a wrong format.
    private bool $isActive; //	Returns "false" if the address doesn't have enough balance or wasn't activate.
    private bool $requiresTag; //	Returns "true" if the address requires tag when used as a transaction destination.

    /**
     * @param bool $isValid
     * @param bool $isActive
     * @param bool $requiresTag
     */
    public function __construct(bool $isValid, bool $isActive, bool $requiresTag)
    {
        $this->isValid = $isValid;
        $this->isActive = $isActive;
        $this->requiresTag = $requiresTag;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @return bool
     */
    public function isRequiresTag(): bool
    {
        return $this->requiresTag;
    }
}