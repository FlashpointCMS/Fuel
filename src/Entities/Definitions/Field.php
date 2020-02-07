<?php

namespace Flashpoint\Fuel\Entities\Definitions;

use Flashpoint\Fuel\Definition;
use Flashpoint\Fuel\Entities\Definitions\Input\Input;
use Flashpoint\Fuel\Entities\Enums\FieldVisibility;

class Field extends Definition
{
    /** @var Input */
    protected $input;
    /** @var string */
    protected $name;
    /** @var string */
    protected $label;
    /** @var FieldVisibility */
    protected $visibility;
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