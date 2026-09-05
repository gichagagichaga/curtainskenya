<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreSubcategoryRequest extends StoreCategoryRequest
{
    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            ...parent::rules(),
            'parent_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id')->whereNull('parent_id'),
            ],
        ];
    }
}
