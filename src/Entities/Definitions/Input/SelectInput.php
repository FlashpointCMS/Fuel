<?php

namespace Flashpoint\Fuel\Entities\Definitions\Input;

class SelectInput extends Input
{
    protected $options;

    public function options(array $options) {
        return $this->setAttribute('options', $options);
    }
}