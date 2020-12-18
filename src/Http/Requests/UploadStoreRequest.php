<?php

namespace DinandMentink\Markdown\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UploadStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "image" => [
                "required",
                "image",
                "max:" . config("nova-markdown.max-size"),
            ],
        ];
    }
}
