<?php

namespace Flashpoint\Fuel;

use Illuminate\Support\Arr;

class State
{
    private $attributes = [];

    public function get($name, $default = null)
    {
        Arr::get($this->attributes, $name, $default);
    }

    public function has($name)
    {
        return Arr::has($this->attributes, $name);
    }

    public function all()
    {
        return $this->attributes;
    }
}