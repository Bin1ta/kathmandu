<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreVideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('video_create');
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'video' => ['required', 'regex:/^https:\/\/www\.youtube\.com\/watch\?v=/'],
            'ward' => ['nullable', 'array'],
            'ward.*' => ['integer'],
            'is_displayed' => ['nullable', 'boolean'],
            'status'=>['nullable']
        ];
    }

    public function messages()
    {
        return [
            'video.required' => 'भिडियो अनिबार्य छ ',
            'video.regex' => ':attribute "https://www.youtube.com/watch?v=" बाट सुरु हुनुपर्छ',
        ];
    }
}
