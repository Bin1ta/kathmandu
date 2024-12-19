<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('employee_create');
    }

    public function rules(): array
    {
        return [
        'name' => ['required', 'string', 'max:255'],
        'department' => ['nullable', 'string'],
        'designation' => ['nullable', 'string'],
        'photo' => ['nullable', 'mimes:png,jpeg,jpg'],
        'email' => ['nullable', 'email', Rule::unique('employees', 'email')->withoutTrashed()],
        'phone' => ['nullable', Rule::unique('employees', 'phone')->withoutTrashed()],
        'position' => ['nullable', 'integer'],
        'status' => ['nullable', 'boolean'],
        'is_employee' => ['required', 'boolean'],
        'employee_id' => ['nullable', Rule::exists('employees', 'id')->withoutTrashed()],
        'show_to_mobile_app' => ['required', 'boolean'],
        'show_to_index' => ['required', 'boolean'],
        'ward' => ['nullable', 'array'],
        'ward.*' => ['integer'],
        'is_displayed' => ['nullable', 'boolean'],
    ];
    }
}
