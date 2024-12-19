<?php

namespace App\Http\Requests\Program;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
class UpdateProgramRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;   }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'date' => ['required'],
            'image'=>['nullable','mimes:png,jpeg,jpg'],
            'ward' => ['nullable', 'array'],
            'ward.*' => ['integer','nullable'],
            'is_displayed' => ['nullable', 'boolean'],
            'status' => ['nullable']
        ];
    }
}
