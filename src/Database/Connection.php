<?php

namespace Flashpoint\Fuel\Migrations;

use Jenssegers\Mongodb\Connection as ConnectionBase;

class Connection extends ConnectionBase
{
    /**
     * @inheritdoc
     */
    public function getSchemaBuilder()
    {
        return new Builder($this);
    }
}