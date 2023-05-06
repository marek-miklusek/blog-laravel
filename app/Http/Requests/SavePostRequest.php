<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePostRequest extends FormRequest
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
        $rules = [
            'title' => ['required', 'unique:posts,title', 'max:200'],
            'text' => ['required'],
            'tags' => ['array'],
        ];

        // How to validate an array('items'), creating
        // validation rule for every item of the array
        $count = count($this->input('items', []));

        foreach (range(0, $count) as $index) {
            $rules["items.$index"] = 'mimes:pdf,txt,doc,csv';
        }

        return $rules;
    }


    public function messages()
	{
        // Error message for each item from array('items')
        $items = $this->file('items') ?? [];
		$messages = [];

        foreach ($items as $key => $value) {
            $messages["items.$key.mimes"] = "All files must be of type: :values";
        }

		return $messages;
	}
}
