<?php

namespace Flashpoint\Fuel\Migrations;

use Illuminate\Support\Facades\Schema as SchemaBase;

/**
 * Class Schema
 * @package Flashpoint\Fuel\Migrations
 *
 * @method static Builder create(string $table, \Closure $callback = null, array $options = [])
 * @method static Builder baseCreate(string $table, \Closure $callback = null, array $options = [])
 * @method bool Builder hasCollection(string $collection)
 */
class Schema extends SchemaBase
{
    /**
     * Overwrite the accessor to provide the flashpoint connection instead.
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    protected static function getFacadeAccessor()
    {
        return static::connection('flashpoint_data');
    }
}