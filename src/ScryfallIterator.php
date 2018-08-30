<?php

namespace Ypho\Scryfall;

class ScryfallIterator implements \Iterator
{
    protected $values = [];

    public function __construct($values)
    {
        $this->values = $values;
    }

    public function count()
    {
        return count($this->values);
    }

    public function rewind()
    {
        reset($this->values);
    }

    public function current()
    {
        return current($this->values);
    }

    public function key()
    {
        return key($this->values);
    }

    public function next()
    {
        return next($this->values);
    }

    public function valid()
    {
        $key = key($this->values);
        return ($key !== null && $key !== false);
    }
}