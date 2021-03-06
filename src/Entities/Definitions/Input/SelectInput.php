<?php

namespace Flashpoint\Fuel\Entities\Definitions\Input;

class SelectInput extends Input
{
    protected $options;

    public function options(array $options)
    {
        return $this->setAttribute('options', $options);
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
        return parent::jsonSerialize() + ['options' => $this->options];
    }

    public function type()
    {
        return 'select';
    }
}