<?php

namespace Flashpoint\Fuel\Entities\Definitions\Input;

class SelectInput extends Input
{
    private $options = [];

    public function options(array $options) {
        return $this->setAttribute('options', $options);
    }
}