<?php

namespace App\Http\Requests\UserManagement\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('user_create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone' => ['nullable', 'numeric', Rule::unique('users', 'phone')],
            'role_id' => ['required', Rule::exists('roles', 'id')->withoutTrashed()],
            'password' => ['required', 'confirmed', 'min:7'],
            'ward_no' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'नाम अनिबार्य छ।',
            'email.required' => 'इमेल फिल्ड अनिबार्य छ।',
            'email.unique' => 'इमेल पहिले नै लिइएको छ।',
            'phone.numeric' => 'फोन अङ्कमा छ ',
            'phone.unique' => 'फोन पहिले नै लिइएको छ।',
            'role_id.required' => 'भूमिका अनिबार्य छ।',
            'password.required' => 'पासवर्ड अनिबार्य छ।',
            'password.confirmed' => 'पासवर्डसंग मेल खाएन।',
            'password.min' => 'पासवर्ड न्युनतम ७ अक्षरको हुनुपर्छ ।',
            'ward_no.integer' => 'वार्ड न. अंकमा हुनुपर्छ ।',
            'branch_id.integer' => 'शाखा अंकमा हुनुपर्छ ।',
        ];
    }
}
