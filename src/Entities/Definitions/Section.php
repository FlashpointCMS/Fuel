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

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'fields' => $this->fields
        ];
    }
}