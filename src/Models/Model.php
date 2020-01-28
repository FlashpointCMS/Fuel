<?php

namespace Flashpoint\Fuel\Models;

use Jenssegers\Mongodb\Eloquent\Model as ModelBase;

class Model extends ModelBase
{
    protected $connection = 'flashpoint';
}