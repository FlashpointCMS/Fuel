<?php

namespace Flashpoint\Fuel\Entities\Definitions\Input;

class MultiSelectInput extends SelectInput
{
    public function type()
    {
        return 'multi_select';
    }
}