<?php

namespace Flashpoint\Fuel\Entities\Definitions\Input;

class CheckboxInput extends Input
{
    protected $text;

    public function containing(string $text)
    {
        return $this->setAttribute('text', $text);
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
        return parent::jsonSerialize() + ['text' => $this->text];
    }

    public function type()
    {
        return 'checkbox';
    }
}