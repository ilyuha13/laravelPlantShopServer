<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlantRequest extends FormRequest
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
            'description' => 'nullable|string',
            'image_paths' => 'nullable|array',
            'image_paths.*' => 'string',
            'varieties_id' => 'required|exists:varieties,id',
            'price' => 'required|numeric|min:0',
            //
        ];
    }

    public function messages(): array
    {
        return [
            'varieties_id.required' => 'The variety ID is required.',
            'varieties_id.exists' => 'The specified variety does not exist.',
            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a numeric value.',
            'price.min' => 'The price must be at least 0.',
        ];
    }
}
