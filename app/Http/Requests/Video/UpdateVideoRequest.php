<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateVideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('video_edit');
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'video' => ['nullable'],
            'ward' => ['nullable', 'array'],
            'ward.*' => ['integer'],
            'is_displayed' => ['nullable', 'boolean'],
            'status' => ['nullable']
        ];
    }

    public function messages()
    {
        return [
            'video.mimes' => 'भिडियो mp4 मा छ ',
        ];
    }
}
