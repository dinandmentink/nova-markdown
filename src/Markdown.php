<?php

namespace DinandMentink\Markdown;

use Laravel\Nova\Fields\Field;

class Markdown extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'markdown';

    /**
     * Indicates if the element should be shown on the index view.
     *
     * We set this to false by default.
     *
     * @var \Closure|bool
     */
    public $showOnIndex = false;
}
