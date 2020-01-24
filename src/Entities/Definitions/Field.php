<?php

namespace Flashpoint\Fuel\Entities\Definitions;

use Flashpoint\Fuel\Entities\Definitions\Input\Input;
use Flashpoint\Fuel\Entities\Enums\FieldVisibility;

class Field extends Definition
{
    /** @var Input */
    private $input;
    /** @var string */
    private $name;
    /** @var string */
    private $label;
    /** @var FieldVisibility */
    private $visibility;
    /** @var mixed */
    private $value;

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
        return $this->setDefinition(
            'input',
            Input::class,
            empty($typeBuilder) ? new $input : $typeBuilder(new $input)
        );
    }

    public function containing(string $value)
    {
        return $this->setAttribute('value', $value);
    }

    public function displayed(FieldVisibility $visibility)
    {
        return $this->setAttribute('visibility', $visibility);
    }

    // Helpers

    public function hidden()
    {
        return $this->displayed(FieldVisibility::invisible());
    }

    public function shown()
    {
        return $this->displayed(FieldVisibility::visible());
    }
}