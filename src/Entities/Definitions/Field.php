<?php

namespace Flashpoint\Fuel\Entities\Definitions;

use Flashpoint\Fuel\Definition;
use Flashpoint\Fuel\Entities\Definitions\Input\Input;

class Field extends Definition
{
    /** @var Input */
    protected $input;
    /** @var string */
    protected $name;
    /** @var string */
    protected $label;
    /** @var bool */
    protected $visible;
    /** @var mixed */
    protected $value;

    public function named(string $name)
    {
        return $this->setAttribute('name', $name);
    }

    public function labeled(string $label)
    {
        return $this->setAttribute('label', $label);
    }

    /**
     * @param string $input This parameter is used to define which kind of input is placed into the builder
     * @param callable|null $typeBuilder
     * @return $this
     */
    public function withInput(string $input, callable $typeBuilder = null)
    {
        $entry = new $input;
        if (!empty($typeBuilder)) {
            $typeBuilder($entry);
        }

        return $this->setDefinition('input', Input::class, $entry);
    }

    public function containing($value)
    {
        return $this->setAttribute('value', $value);
    }

    public function visibility(bool $visible)
    {
        return $this->setAttribute('visible', $visible);
    }

    // Helpers

    public function hidden()
    {
        return $this->visibility(false);
    }

    public function shown()
    {
        return $this->visibility(true);
    }

    public function name()
    {
        return $this->name;
    }

    public function value()
    {
        return $this->value;
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
            'input' => $this->input,
            'name' => $this->name,
            'label' => $this->label,
            'visible' => $this->visible ?? true,
            'value' => $this->value
        ];
    }
}