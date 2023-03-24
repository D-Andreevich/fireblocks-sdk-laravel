<?php

namespace FireblocksSdkLaravel\Types\Request\Base;

use FireblocksSdkLaravel\Types\Enums\EnumCustom;

trait ToArray
{
    public function toArray(): array
    {
        $allVariables = get_object_vars($this);
        $result = [];
        foreach ($allVariables as $name => $value) {
            if (isset($value)) {
                $valueReady = $value;
                if ($value instanceof EnumCustom) {
                    $valueReady = (string)$value;
                } elseif ($value instanceof ToArrayAccess) {
                    $valueReady = $value->toArray();
                }
                $result[$name] = $valueReady;
            }
        }
        return $result;
    }
}