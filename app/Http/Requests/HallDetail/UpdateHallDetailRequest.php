<?php

namespace App\Http\Requests\HallDetail;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHallDetailRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'status' => ['nullable', 'boolean'],
            'ward' => ['nullable', 'array'],
            'ward.*' => ['integer'],
            'is_displayed' => ['nullable', 'boolean'],
        ];
    }
}
