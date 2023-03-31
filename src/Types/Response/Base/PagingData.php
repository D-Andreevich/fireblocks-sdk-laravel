<?php

namespace FireblocksSdkLaravel\Types\Response\Base;

class PagingData
{
    private ?string $before;
    private ?string $after;

    /**
     * @param string|null $before
     * @param string|null $after
     */
    public function __construct(?string $before = null, ?string $after = null)
    {
        $this->before = $before;
        $this->after = $after;
    }

    /**
     * @return string|null
     */
    public function getBefore(): ?string
    {
        return $this->before;
    }

    /**
     * @return string|null
     */
    public function getAfter(): ?string
    {
        return $this->after;
    }

}