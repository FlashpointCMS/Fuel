<?php

namespace Flashpoint\Fuel\Entities\Definitions;

use Flashpoint\Fuel\Definition;

class Collection extends Definition
{
    protected $fields = [];

    public function includeField(callable $fieldBuilder)
    {
        return $this->addDefinition('fields', Field::class, $fieldBuilder);
    }
}