<?php

namespace Flashpoint\Fuel;

use Flashpoint\Fuel\Entities\Definitions\Entity;
use Flashpoint\Fuel\Models\Model;

class Routing extends Definition
{
    /** @var Entity */
    protected $entity;
    /** @var Model */
    protected $model;
    /** @var Observer[] */
    protected $observers = [];
    /** @var string */
    protected $name;

    public function withEntity(string $entity)
    {
        return $this->setDefinition('entity', Entity::class, $entity);
    }

    public function withModel(string $model)
    {
        return $this->setDefinition('model', Model::class, $model);
    }

    public function includeObserver(string $observer)
    {
        return $this->addDefinition('observers', Observer::class, $observer);
    }

    public function named(string $name)
    {
        return $this->setAttribute('name', $name);
    }

    public static function bind(string $name)
    {
        return (new static())->named($name);
    }

    /**
     * @return Model::class
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * @return Entity::class
     */
    public function entity()
    {
        return $this->entity;
    }

    public function name()
    {
        return $this->name;
    }

    public function observers() {
        return $this->observers;
    }
}