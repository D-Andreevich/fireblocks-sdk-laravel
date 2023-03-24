<?php

namespace FireblocksSdkLaravel\Types\Response\Base;

class ResponseData
{
    private mixed $data = null;

    public function __construct(mixed $data = null)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data ?? [];
    }
}