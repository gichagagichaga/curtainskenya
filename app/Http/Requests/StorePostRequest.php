<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', Rule::unique('posts', 'slug')],
            'blog_category_id' => ['nullable', 'integer', 'exists:blog_categories,id'],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'featured_image_alt' => ['nullable', 'string', 'max:255', 'required_with:featured_image'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'published_at' => ['nullable', 'date'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:180'],
            'seo_keywords' => ['nullable', 'string', 'max:1000'],
            'canonical_url' => ['nullable', 'url', 'max:255', Rule::unique('posts', 'canonical_url')],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:180'],
            'og_image' => ['nullable', 'url', 'max:255'],
            'noindex' => ['nullable', 'boolean'],
            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => ['integer', 'exists:tags,id'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['integer', 'exists:products,id'],
            'related_post_ids' => ['nullable', 'array'],
            'related_post_ids.*' => ['integer', 'exists:posts,id'],
        ];
    }
}
