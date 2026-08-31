<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateTagRequest extends StoreTagRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $tag = $this->route('tag');
        $rules['slug'] = ['nullable', 'string', 'max:255', 'alpha_dash', Rule::unique('tags', 'slug')->ignore($tag)];

        return $rules;
    }
}
