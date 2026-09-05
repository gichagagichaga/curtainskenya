<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

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
            'parent_category_id' => ['required', 'integer', Rule::exists('categories', 'id')->whereNull('parent_id')],
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

    /**
     * @return array<int, callable>
     */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                if ($validator->errors()->hasAny(['parent_category_id', 'category_id'])) {
                    return;
                }

                $belongsToParent = Category::query()
                    ->whereKey($this->integer('category_id'))
                    ->where(function ($query): void {
                        $query->whereKey($this->integer('parent_category_id'))
                            ->orWhere('parent_id', $this->integer('parent_category_id'));
                    })
                    ->exists();

                if (! $belongsToParent) {
                    $validator->errors()->add('category_id', 'The selected subcategory does not belong to the chosen category.');
                }
            },
        ];
    }
}
