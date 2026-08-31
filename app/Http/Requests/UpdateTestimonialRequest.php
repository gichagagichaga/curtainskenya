<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->hasRole(User::ROLE_CONTENT_MANAGER) ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'review' => ['required', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:1000000'],
            'is_published' => ['nullable', 'boolean'],
        ];
    }
}
