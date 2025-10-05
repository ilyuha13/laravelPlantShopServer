<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreTestRequest extends FormRequest
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
        //dd($this->all());
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'required|array',
            'images.*' => 'image|max:5120', // Максимальный размер
        ];

    }

    public function messages(): array
    {
      return   [
            'name.required' => 'name is required',
            'description.required' => 'description is required',
        ];
        
    }
}
