<?php

namespace Flashpoint\Fuel;

use Illuminate\Support\Arr;

class State
{
    private $attributes = [];

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function get($name, $default = null)
    {
        return Arr::get($this->attributes, $name, $default);
    }

    public function has($name)
    {
        return Arr::has($this->attributes, $name);
    }

    public function put($name, $value)
    {
        return Arr::set($this->attributes, $name, $value);
    }

    public function set($state)
    {
        $this->attributes = array_merge_recursive($this->attributes, $state);
        return $this;
    }

    public function all()
    {
        return $this->attributes;
    }
}