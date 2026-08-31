<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:255', 'unique:products,sku'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'decimal:0,2', 'min:0'],
            'sale_price' => ['nullable', 'decimal:0,2', 'min:0', 'lte:price'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'images' => ['nullable', 'array', 'max:8'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'alt_texts' => ['nullable', 'array'],
            'alt_texts.*' => ['nullable', 'string', 'max:255'],
        ];
    }
}
