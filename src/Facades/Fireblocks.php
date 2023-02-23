<?php

namespace FireblocksSdkLaravel\Facades;

use FireblocksSdkLaravel\FireblocksSdkClient;
use Illuminate\Support\Facades\Facade;

class Fireblocks extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return FireblocksSdkClient::class;
    }
}