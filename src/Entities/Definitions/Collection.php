<?php

namespace Flashpoint\Fuel\Entities\Definitions;

class Collection extends Definition
{
    private $fields = [];

    public function includeField(callable $fieldBuilder)
    {
        return $this->addDefinition('fields', Field::class, $fieldBuilder);
    }
}