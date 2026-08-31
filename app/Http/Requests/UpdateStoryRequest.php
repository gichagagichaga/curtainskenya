<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'eyebrow' => ['nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'intro' => ['required', 'string', 'max:1000'],
            'body' => ['nullable', 'string', 'max:3000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'image_alt' => ['nullable', 'string', 'max:255', 'required_with:image'],
        ];
    }
}
