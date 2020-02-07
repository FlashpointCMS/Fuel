<?php

namespace Flashpoint\Fuel\Entities\Definitions;

use Flashpoint\Fuel\Definition;

class Section extends Definition
{
    protected $name;
    protected $fields = [];

    public function includeField(callable $fieldBuilder)
    {
        return $this->addDefinition('fields', Field::class, $fieldBuilder);
    }

    public function named(string $name)
    {
        return $this->setAttribute('name', $name);
    }

    // Query

    /**
     * @param string $name
     * @return Field
     */
    public function findField(string $name)
    {
        return $this->findEntry('fields', function (Field $field) use ($name) {
            return $field->getEntry('name') == $name;
        });
    }
}