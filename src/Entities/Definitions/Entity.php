<?php

namespace Flashpoint\Fuel\Entities\Definitions;

use Flashpoint\Fuel\Definition;
use Flashpoint\Fuel\Entities\Enums\EntityType;
use Flashpoint\Fuel\Models\Model;
use Flashpoint\Fuel\State;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class Entity
 * @package Flashpoint\Fuel\Entities
 *
 * @method static Collection collection(Collection $collection)
 */
abstract class Entity extends Definition
{
    // Definition

    protected $sections = [];

    /**
     * @return EntityType
     */
    public static function type()
    {
        // We need to know if there is a type... If there isn't we are in trouble
        // TODO: Objectify Flashpoint Exceptions, rather than depending on built-ins
        throw new \RuntimeException('Entity type not set for ' . get_class());
    }

    public function withCollection(callable $storeBuilder)
    {

        return $this->setDefinition('collection', Collection::class, $storeBuilder);
    }

    public function includeSection(callable $editorBuilder)
    {
        return $this->addDefinition('sections', Section::class, $editorBuilder);
    }

    // Query

    /**
     * @param string $name
     * @return Section
     */
    public function findSection(string $name)
    {
        return $this->findEntry('sections', function (Section $section) use ($name) {
            return $section->getEntry('name') == $name;
        });
    }

    // Functional

    protected $store;
    /** @var State */
    protected $state;

    public function __construct(Model $store, State $state)
    {
        $this->store = $store;
        $this->state = $state;

//        // If we have a plural collection (ie. there can be more than one instance of it), then run the builder.
//        // The builder is always named 'collection', and will be passed the Collection definition object
//        if (static::type()->isPlural()) {
//            if (!method_exists($this, 'collection')) {
//                throw new \RuntimeException('Collection builder not set for ' . get_class());
//            }
//            $this->withCollection(function (Collection $collection) {
//                return $this->collection($collection);
//            });
//        }

        // Get all the sections builder methods
        $sectionBuilders = Arr::where(get_class_methods($this), function ($methodName) {
            return preg_match('/^section[A-Z0-9][a-z0-9]*/', $methodName);
        });

        foreach ($sectionBuilders as $sectionBuilder) {
            $this->includeSection(function (Section $section) use ($sectionBuilder) {
                $this->{$sectionBuilder}($section);
                $section->named(Str::snake(Str::replaceFirst('section', '', $sectionBuilder)));
            });
        }
    }
}