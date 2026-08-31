<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdatePostRequest extends StorePostRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $post = $this->route('post');

        $rules['slug'] = ['nullable', 'string', 'max:255', 'alpha_dash', Rule::unique('posts', 'slug')->ignore($post)];
        $rules['canonical_url'] = ['nullable', 'url', 'max:255', Rule::unique('posts', 'canonical_url')->ignore($post)];

        return $rules;
    }
}
