<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tag' => ['required', 'max:60', 'regex:/^[a-zA-Z0-9]+([-][a-zA-Z0-9]+)*$/'],
        ];
    }


    // Error message for tag.regex
    public function messages()
    {
        return [
            'tag.regex' => 'The tag may only contain letters, numbers, and hyphens.',
        ];
    }
}
