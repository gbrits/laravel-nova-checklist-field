<?php

namespace Mxms\Checklist;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\SupportsDependentFields;

class Checklist extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'checklist';
    public function logUsers($column = 'name')
    {
        return $this->withMeta(['user' => auth()->user()->{$column}]);
    }

    public function showTimestamps()
    {
        return $this->withMeta(['show_timestamps' => true]);
    }

    public function showItemStatusOnIndex()
    {
        return $this->withMeta(['show_item_status' => true]);
    }

    public function showCompletionOnIndex()
    {
        return $this->withMeta(['show_completion' => true]);
    }

    public function placeholder($text = null)
    {
        return $this->withMeta(['placeholder' => $text]);
    }

    public function withPlaceholderCount()
    {
        return $this->withMeta(['placeholder_count' => true]);
    }

    protected function fillAttributeFromRequest(NovaRequest $request,
                                                $requestAttribute,
                                                $model,
                                                $attribute)
    {
        if ($request->exists($requestAttribute)) {
            $model->{$attribute} = $request[$requestAttribute];
        }
    }
}
