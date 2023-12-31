<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_category' => ['required', 'exists:product_categories,id'],
            'name' => ['required'],
            'code' => ['required', 'unique:products,code,'.$this->product->id],
            'price' => ['required', 'numeric'],
            'product_type' => ['required', 'in:product,service']
        ];
    }
}
