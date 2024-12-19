<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('employee_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'department' => ['nullable', 'string'],
            'designation' => ['nullable', 'string'],
            'photo' => ['nullable', 'mimes:png,jpeg,jpg'],
            'email' => ['nullable', 'email', Rule::unique('employees', 'email')->withoutTrashed()->ignore($this->employee)],
            'phone' => ['nullable', Rule::unique('employees', 'phone')->withoutTrashed()->ignore($this->employee)],
            'position' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
            'is_employee' => ['required', 'boolean'],
            'employee_id' => ['nullable', Rule::exists('employees', 'id')->withoutTrashed()],
            'show_to_mobile_app' => ['required', 'boolean'],
            'show_to_index' => ['required', 'boolean'],
            'ward' => ['nullable', 'array'],
            'ward.*' => ['string','nullable'],
            'is_displayed' => ['nullable', 'boolean']
        ];
    }
}
