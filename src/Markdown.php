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

    /**
     * Construct the Markdown field.
     *
     * This is used to set some default meta information which the FormField
     * requires.
     */

    function __construct(
        $name,
        $attribute = null,
        callable $resolveCallback = null
    ) {
        parent::__construct($name, $attribute);

        return $this->withMeta([
            "uploads" => config("nova-markdown.uploads"),
            "uploadEndpoint" => route("nova-markdown.uploads.store"),
            "maxSize" => config("nova-markdown.max-size"),
        ]);
    }

    /**
     * Enable or disable uploads on this field.
     */

    public function uploads(bool $enabled)
    {
        return $this->withMeta([
            "uploads" => $enabled,
        ]);
    }

    /**
     * Set the maximum image size, in kilobytes, for this field.
     */

    public function maxSize($maxSize)
    {
        return $this->withMeta([
            "maxSize" => $maxSize,
        ]);
    }
}
