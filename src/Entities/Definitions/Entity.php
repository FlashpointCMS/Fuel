<?php

namespace Flashpoint\Fuel\Entities\Definitions;

use Flashpoint\Fuel\Definition;
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
    protected $section = 'main';
    protected $meta;

    /**
     * @return bool
     */
    public static function plural()
    {
        // We need to know if there is a type... If there isn't we are in trouble
        // TODO: Objectify Flashpoint Exceptions, rather than depending on built-ins
        throw new \RuntimeException('Entity type not set for ' . get_class());
    }

    /**
     * @return string
     */
    public static function type()
    {
        // TODO: Objectify Flashpoint Exceptions, rather than depending on built-ins
        throw new \RuntimeException('Entity type not set for ' . get_class());
    }

    public static function title()
    {
        // TODO: Objectify Flashpoint Exceptions, rather than depending on built-ins
        throw new \RuntimeException('Entity title not set for ' . get_class());
    }

    public static function description()
    {
        // TODO: Objectify Flashpoint Exceptions, rather than depending on built-ins
        throw new \RuntimeException('Entity description not set for ' . get_class());
    }

    public function includeSection(callable $editorBuilder)
    {
        return $this->addDefinition('sections', Section::class, $editorBuilder);
    }

    public function section($value)
    {
        return $this->setAttribute('section', $value);
    }

    public function meta($value)
    {
        return $this->setAttribute('meta', $value);
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

    public function __construct(State $state, Model $store)
    {
        $this->state = $state;
        $this->store = $store;

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

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'sections' => $this->sections,
            'section' => $this->section,
            '_meta' => $this->meta
        ];
    }
}