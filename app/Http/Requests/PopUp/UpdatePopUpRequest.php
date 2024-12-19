<?php

namespace App\Http\Requests\PopUp;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePopUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'display_duration' => ['nullable','integer'],
            'iteration_duration' => ['nullable','integer'],
            'image'=>['nullable','mimes:png,jpeg,jpg'],
            'ward' => ['nullable', 'array'],
            'ward.*' => ['integer'],
            'is_displayed' => ['nullable', 'boolean'],
        ];
    }
}
