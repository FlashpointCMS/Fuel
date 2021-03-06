<?php

namespace Flashpoint\Fuel\Models;

use Jenssegers\Mongodb\Eloquent\Model as ModelBase;

class Model extends ModelBase
{
    protected $connection = 'flashpoint_data';

    /** \Illuminate\Database\Eloquent\Builder */
    public static function queryForContent()
    {
        return static::query();
    }
}