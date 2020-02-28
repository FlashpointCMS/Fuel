<?php

namespace Flashpoint\Fuel\Entities\Helpers;

use Flashpoint\Fuel\Entities\Definitions\Entity;

class SingularEntity extends Entity
{
    /**
     * @return bool
     */
    public static function plural()
    {
        return false;
    }

    /**
     * @return string
     */
    public static function type()
    {
        return 'entity';
    }
}