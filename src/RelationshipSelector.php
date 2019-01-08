<?php
namespace Eminiarts\RelationshipSelector;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Contracts\Resolvable;

class RelationshipSelector extends Field
{
    /**
     * @var string
     */
    public $activeOption = '';

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'relationship-selector';

    /**
     * @var array
     */
    public $options = [];

    /**
     * @var mixed
     */
    public $showOnCreation = false;

    /**
     * @var mixed
     */
    public $showOnDetail = true;

    /**
     * @var mixed
     */
    public $showOnIndex = false;

    /**
     * @var mixed
     */
    public $showOnUpdate = false;

    /**
     * You can set the active Option
     * @param  $name
     * @return mixed
     */
    public function activeOption($name)
    {
        $this->activeOption = $name;

        return $this;
    }

    /**
     * Add an Option to the Select Field
     * @param  $name
     * @param  $field
     * @param  $relationType
     * @return mixed
     */
    public function addOption($name, $field, $relationType = '')
    {
        if (call_user_func([$field->resourceClass, 'authorizedToViewAny'], request())) {
            $this->options[] = [
                'name'           => $name,
                'field'          => $field,
                'targetRelation' => $field->attribute,
                'panel'          => $field->component == 'belongs-to-field' ? $name : null,
            ];

            if ($field->component == 'belongs-to-field') {
                $field->panel       = $name;
                $field->belongsToId = '';
                $field->value       = '';
            }
        }

        return $this;
    }

    /**
     * Get additional meta information to merge with the field payload.
     *
     * @return array
     */
    public function meta()
    {
        return array_merge([
            'activeOption' => $this->activeOption,
            'options'      => $this->options,
            'listable'     => true,
        ], $this->meta);
    }

    /**
     * Resolve the fields in the Options
     * @return mixed
     */
    public function resolve($resource, $attribute = null)
    {
        return collect($this->options)->each(function ($option, $key) use ($resource) {
            if ($option['field'] instanceof Resolvable) {
                $option['field']->resolve($resource);
            };
        });
    }

    /**
     * Show the Select Options on the right side
     * @param $value
     */
    public function withSelect()
    {
        return $this->withMeta(['extraAttributes' => [
            'withSelect' => true],
        ]);
    }
}
