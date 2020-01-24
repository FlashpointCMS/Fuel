<?php

namespace Flashpoint\Fuel\Entities\Definitions;

use Illuminate\Support\Arr;

abstract class Definition
{
    protected function addDefinition($key, $type, $entry)
    {
        if (!is_iterable($this->$key)) {
            $class = static::class;
            throw new \ParseError("Container is not an iterable. Can not add to {$class}->{$key}");
        }
        if (!is_a($entry, $type)) {
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

    protected function setDefinition($key, $type, $entry)
    {
        if (!is_null($this->$key)) {
            $class = static::class;
            throw new \RuntimeException("Item was overwritten when setting {$class}->{$key}");
        }
        if (!is_a($entry, $type)) {
            throw new \RuntimeException("Item can not be added to {$key} as the builder did not return {$type}");
        }
        $this->$key = $entry;
        return $this;
    }

    protected function setAttribute($key, $entry)
    {
        if (!is_null($this->$key)) {
            $class = static::class;
            throw new \RuntimeException("Item was overwritten when setting {$class}->{$key}");
        }
        $this->$key = $entry;
        return $this;
    }

    public function getEntry($key, $default = null)
    {
        return $this->{$key} ?? $default;
    }

    public function findEntry($key, $finder)
    {
        if(!is_array($this->{$key})) {
            throw new \RuntimeException("Entry is not an array {$class}->{$key}");
        }

        $entry = Arr::first($this->{$key}, $finder);

        if(empty($entry)) {
            throw new \RuntimeException("Entry not found");
        }

        return $entry;
    }
}