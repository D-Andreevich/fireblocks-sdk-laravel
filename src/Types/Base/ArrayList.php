<?php

namespace FireblocksSdkLaravel\Types\Base;


abstract class ArrayList implements \Countable, \Iterator
{
    protected array $list = [];
    private int $position = 0;

    public function count(): int
    {
        return count($this->list);
    }

    public function current()
    {
        return $this->list[$this->position];
    }

    public function next()
    {
        $this->position++;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->list[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }
}