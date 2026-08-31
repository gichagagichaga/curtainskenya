<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBlogCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', Rule::unique('blog_categories', 'slug')],
            'description' => ['nullable', 'string', 'max:1000'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:180'],
            'noindex' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
