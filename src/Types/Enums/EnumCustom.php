<?php
namespace FireblocksSdkLaravel\Types\Enums;


abstract class EnumCustom
{

    private $value;

    final private function __construct($value)
    {
        $this->value = $value;
    }

    final static public function __callStatic($name, $arguments)
    {
        return new static(constant(get_called_class() . '::' . $name));
    }

    final public function __toString()
    {
        return $this->value;
    }
}