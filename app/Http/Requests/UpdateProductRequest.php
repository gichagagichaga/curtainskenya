<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateProductRequest extends StoreProductRequest
{
    /**
     * @return array<string, array<int, string|Rule>>
     */
    public function rules(): array
    {
        $rules = parent::rules();
        $product = $this->route('product');

        $rules['sku'] = ['nullable', 'string', 'max:255', Rule::unique('products', 'sku')->ignore($product)];

        return $rules;
    }
}
