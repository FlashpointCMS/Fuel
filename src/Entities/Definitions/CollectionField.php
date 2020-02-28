<?php

namespace Flashpoint\Fuel\Entities\Definitions;

use Flashpoint\Fuel\Definition;
use Flashpoint\Fuel\Entities\Definitions\Input\Input;
use Flashpoint\Fuel\Entities\Enums\FieldVisibility;
use Flashpoint\Fuel\Models\Model;
use Flashpoint\Fuel\State;

class CollectionField extends Field
{
    /** @var callable|mixed[] */
    protected $value;

    /**
     * @param callable $picker
     * @return CollectionField|Field
     */
    public function containing($picker)
    {
        return $this->setAttribute('value', $picker);
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
            'visible' => $this->visible ?? true
        ];
    }
}