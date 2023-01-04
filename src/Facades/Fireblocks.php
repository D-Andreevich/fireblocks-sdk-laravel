<?php

namespace DAndreevich\FireblocksSdkLaravel\Facades;

use DAndreevich\FireblocksSdkLaravel\FireblocksSDK;
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
        return FireblocksSDK::class;
    }
}