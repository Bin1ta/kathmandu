<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOfficeSettingRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'site_address' => ['nullable', 'string'],
            'logo' => ['nullable', 'mimes:png,jpg,jpeg,gif'],
            'logo1' => ['nullable', 'mimes:png,jpg,jpeg,gif'],
            'logo2' => ['nullable', 'mimes:png,jpg,jpeg,gif'],
            'background_image' => ['nullable', 'mimes:png,jpg,jpeg'],
            'phone' => ['nullable'],
            'email' => ['nullable'],
            'province_id' => ['nullable', Rule::exists('provinces', 'id')->withoutTrashed()],
            'district_id' => ['nullable', Rule::exists('districts', 'id')->withoutTrashed()],
            'local_body_id' => ['nullable', Rule::exists('local_bodies', 'id')->withoutTrashed()],
            'fiscal_year_id' => ['nullable', Rule::exists('fiscal_years', 'id')->withoutTrashed()],
            'ward_no' => ['nullable'],
        ];
    }
}
