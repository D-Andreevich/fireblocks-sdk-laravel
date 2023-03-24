<?php

namespace FireblocksSdkLaravel\Types\Response\Base;

class PagingData
{
    private string $before;
    private string $after;

    /**
     * @param string $before
     * @param string $after
     */
    public function __construct(string $before, string $after)
    {
        $this->before = $before;
        $this->after = $after;
    }

    /**
     * @return string
     */
    public function getBefore(): string
    {
        return $this->before;
    }

    /**
     * @return string
     */
    public function getAfter(): string
    {
        return $this->after;
    }


}