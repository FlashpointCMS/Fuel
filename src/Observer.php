<?php

namespace Flashpoint\Fuel;

use Flashpoint\Fuel\Entities\Definitions\Entity;
use Flashpoint\Fuel\Models\Model;

class Observer
{
    /** @var Model */
    protected $store;
    /** @var State */
    protected $state;
    /** @var Entity */
    protected $entity;

    public function __construct(Model $store, State $state, Entity $entity)
    {
        $this->store = $store;
        $this->state = $state;
        $this->entity = $entity;
    }
}