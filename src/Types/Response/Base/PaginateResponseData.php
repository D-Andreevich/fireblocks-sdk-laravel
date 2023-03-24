<?php

namespace FireblocksSdkLaravel\Types\Response\Base;

class PaginateResponseData extends ResponseData
{
    private PageDetails $pageDetails;

    /**
     * @return PageDetails
     */
    public function getPageDetails(): PageDetails
    {
        return $this->pageDetails;
    }

    public function __construct(mixed $data, array $pageDetails)
    {
        parent::__construct($data);
        $this->pageDetails = new PageDetails(...$pageDetails);
    }
}