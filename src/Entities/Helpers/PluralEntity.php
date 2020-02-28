<?php

namespace Flashpoint\Fuel\Entities\Helpers;

use Flashpoint\Fuel\Entities\Definitions\Entity;

class PluralEntity extends Entity
{
    /**
     * @return bool
     */
    public static function plural()
    {
        return true;
    }

    /**
     * @return string
     */
    public static function type()
    {
        return 'collection';
    }
}