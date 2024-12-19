<?php

namespace App\Http\Requests\Header;

use Illuminate\Foundation\Http\FormRequest;

class StoreHeaderRequest extends FormRequest
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
            'title'=>['required','string','max:255'],
            'font'=>['required','string','max:255'],
            'font_size'=>['required','string','max:255'],
            'position'=>['nullable','string','max:255'],
            'font_color'=>['required','string','max:255'],
        ];
    }
}
