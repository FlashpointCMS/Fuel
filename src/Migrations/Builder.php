<?php

namespace Flashpoint\Fuel\Migrations;

use Closure;
use Jenssegers\Mongodb\Schema\Blueprint;
use Jenssegers\Mongodb\Schema\Builder as BuilderBase;

class Builder extends BuilderBase
{
    /**
     * @inheritDoc
     *
     * Additionally adds the additional indexes that Flashpoint needs to in order to work
     *
     * @param $collection
     * @param Closure|null $callback
     * @param array $options
     */
    public function create($collection, Closure $callback = null, array $options = [])
    {
        parent::create($collection, function(Blueprint $schema) use ($callback) {
            $schema->index('_entry_id');
            $callback($schema);
        }, $options);
    }

    /**
     * Binds to parent create methods, thus removing our additional stuff
     *
     * @param $collection
     * @param Closure|null $callback
     * @param array $options
     */
    public function baseCreate($collection, Closure $callback = null, array $options = [])
    {
        parent::create($collection, $callback, $options);
    }
}