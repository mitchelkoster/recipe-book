<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'portions' => 'required|integer|max:255',
            'tags' => 'array',
            'tags.*' => 'string|max:255',
            'steps' => 'array',
            'steps.*.description' => 'string',
            'steps.*.instructions' => 'string'
        ];
    }
}
