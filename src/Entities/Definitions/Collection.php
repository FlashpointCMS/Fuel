<?php

namespace Flashpoint\Fuel\Entities\Definitions;

use Flashpoint\Fuel\Definition;
use Flashpoint\Fuel\Models\Model;
use Flashpoint\Fuel\State;
use Illuminate\Support\Collection as LaravelCollection;

class Collection extends Definition
{
    /** @var CollectionField[] */
    protected $fields = [];
    protected $entries = [];

    public function includeField(callable $fieldBuilder)
    {
        return $this->addDefinition('fields', CollectionField::class, $fieldBuilder);
    }


    public function populate(callable $provider)
    {
        $builder = function (State $state, Model $model) {
            return LaravelCollection::wrap($this->fields)
                ->reduce(function (LaravelCollection $fields, CollectionField $field) use ($state, $model){
                    return $fields->put($field->name(), ($field->value())($state, $model));
                }, collect());
        };

        foreach($provider($builder) as $entry) {
            /** @var LaravelCollection $entry */
            $this->entries[] = $entry->toArray();
        }

        return $this;
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
            'fields' => $this->fields,
            'entries' => $this->entries
        ];
    }
}