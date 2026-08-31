<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateBlogCategoryRequest extends StoreBlogCategoryRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $category = $this->route('blog_category');
        $rules['slug'] = ['nullable', 'string', 'max:255', 'alpha_dash', Rule::unique('blog_categories', 'slug')->ignore($category)];

        return $rules;
    }
}
