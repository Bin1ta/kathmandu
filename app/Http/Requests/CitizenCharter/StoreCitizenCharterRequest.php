<?php

namespace App\Http\Requests\CitizenCharter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCitizenCharterRequest extends FormRequest
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
            'branch_id' => ['required','string',Rule::exists('branches', 'id')],
            'service' => ['required','string'],
            'required_document' =>['nullable','string'],
            'amount' => ['required','string'],
            'time' => ['required','string'],
            'responsible_person' => ['required','string'],
            'ward' => ['nullable', 'array'],
            'ward.*' => ['integer'],
            'is_displayed' => ['nullable', 'boolean'],
        ];
    }
}
