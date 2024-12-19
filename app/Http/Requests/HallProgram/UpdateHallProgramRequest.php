<?php

namespace App\Http\Requests\HallProgram;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHallProgramRequest extends FormRequest
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
            'hall_id'=>['nullable',Rule::exists('halls','id')->withoutTrashed()],
            'program_name'=>['required','string'],
            'program_detail'=>['required','string'],
            'program_date'=>['required','date'],
            'program_time_to'=>['required','string'],
            'program_time_from'=>['required','string'],
            'remarks'=>['nullable','string'],
            'status'=>['required','boolean'],
            'ward' => ['nullable', 'array'],
            'ward.*' => ['integer'],
            'is_displayed' => ['nullable', 'boolean'],
        ];
    }
}
