<?php

namespace Flashpoint\Fuel;

use Illuminate\Support\Arr;

abstract class Definition implements \ArrayAccess, \JsonSerializable
{
    protected function addDefinition($key, $type, $builder)
    {
        if(is_callable($builder)){
            $entry = new $type;
            $builder($entry);
        } else {
            $entry = $builder;
        }

        if (!is_iterable($this->$key)) {
            $class = static::class;
            throw new \ParseError("Container is not an iterable. Can not add to {$class}->{$key}");
        }
        if (!is_a($entry, $type, true)) {
            throw new \RuntimeException("Definition can not be added to {$key} as the builder did not return {$type}");
        }
        $this->$key[] = $entry;
        return $this;
    }

    protected function addAttribute($key, $entry)
    {
        if (!is_iterable($this->$key)) {
            $class = static::class;
            throw new \ParseError("Container is not an iterable. Can not add to {$class}->{$key}");
        }
        $this->$key[] = $entry;
        return $this;
    }

    protected function setDefinition($key, $type, $builder)
    {
        if(is_callable($builder)){
            $entry = new $type;
            $builder($entry);
        } else {
            $entry = $builder;
        }

        if (!is_null($this->$key)) {
            $class = static::class;
            throw new \RuntimeException("Item was overwritten when setting {$class}->{$key}");
        }
        if (!is_a($entry, $type, true)) {
            throw new \RuntimeException("Item can not be added to {$key} as the builder did not return {$type}");
        }
        $this->$key = $entry;
        return $this;
    }

    protected function setAttribute($key, $entry)
    {
        $this->$key = $entry;
        return $this;
    }

    public function getEntry($key, $default = null)
    {
        return $this->$key ?? $default;
    }

    public function findEntry($key, $finder)
    {
        if (!is_array($this->$key)) {
            $class = static::class;
            throw new \RuntimeException("Entry is not an array {$class}->{$key}");
        }

        $entry = Arr::first($this->$key, $finder);

        if (empty($entry)) {
            throw new \RuntimeException("Entry not found");
        }

        return $entry;
    }

    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        throw new \RuntimeException("External access is immutable");
    }

    public function offsetUnset($offset)
    {
        throw new \RuntimeException("External access is immutable");
    }
}