<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|mimes:png,jpg',
            'category_id' => 'required|exists:categories,id',
            
        ];
    }

    // to change the filed name in the default error messages
    // __ YOU CAN CUSTOMIZE YOUR ERROR MESSAGES USING FUNC MESSAGES __
    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'category_id' => 'Category',
            
        ];
    }
}
