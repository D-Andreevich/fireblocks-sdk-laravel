<?php

namespace FireblocksSdkLaravel\Types\Response\Base;

class PageDetails
{
    private string $prevPage;
    private string $nextPage;

    /**
     * @param string $prevPage
     * @param string $nextPage
     */
    public function __construct(string $prevPage, string $nextPage)
    {
        $this->prevPage = $prevPage;
        $this->nextPage = $nextPage;
    }

    /**
     * @return string
     */
    public function getPrevPage(): string
    {
        return $this->prevPage;
    }

    /**
     * @return string
     */
    public function getNextPage(): string
    {
        return $this->nextPage;
    }
}