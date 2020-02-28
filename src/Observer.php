<?php

namespace Flashpoint\Fuel;

use Flashpoint\Fuel\Entities\Definitions\Entity;
use Flashpoint\Fuel\Models\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Observer
{
    /** @var Model */
    protected $store;
    /** @var State */
    protected $state;
    /** @var Entity */
    protected $entity;
    /** @var Request */
    protected $request;

    public function __construct(Model $store, State $state, Entity $entity, Request $request)
    {
        $this->store = $store;
        $this->state = $state;
        $this->entity = $entity;
        $this->request = $request;
    }

    /**
     * Returns the handling methods or null
     */
    public static function canHandleBy($action, $name = null)
    {
        $methods = [];

        $action = Str::studly($action);
        $name = is_null($name) ? null : Str::studly($name);

        if (!is_null($name) && method_exists(static::class, "when{$action}{$name}")) {
            $methods[] = [static::class, "when{$action}{$name}"];
        }

        if (method_exists(static::class, "when{$action}")) {
            $methods[] = [static::class, "when{$action}"];
        }

        return sizeof($methods) > 0 ? $methods : null;
    }
}