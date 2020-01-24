<?php

namespace Flashpoint\Fuel\Entities\Helpers;

use Flashpoint\Fuel\Entities\Definitions\Entity;
use Flashpoint\Fuel\Entities\Enums\EntityType;

class SingularEntity extends Entity
{
    /**
     * @return EntityType
     */
    public static function type()
    {
        return EntityType::singular();
    }
}