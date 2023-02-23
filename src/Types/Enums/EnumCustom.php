<?php

namespace FireblocksSdkLaravel\Types\Enums;


abstract class EnumCustom
{

    private $value;

    final private function __construct($value)
    {
        $this->value = $value;
    }

    final static public function __callStatic(string $name, array $arguments)
    {
        if ($name[0] !== '_') {
            $name = "_{$name}";
        }
        return new static(constant(get_called_class() . '::' . $name));
    }

    final public function __toString()
    {
        return $this->value;
    }
}