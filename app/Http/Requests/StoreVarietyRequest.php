<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVarietyRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:varieties,name',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120',
            'life_form' => 'nullable|string|max:255',
            'variegation' => 'nullable|string|max:255',
            'species_id' => 'required|exists:species,id',
            
        ];
    }
}
