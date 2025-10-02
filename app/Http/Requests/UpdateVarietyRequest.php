<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVarietyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_urls' => 'nullable|array',
            'image_urls.*' => 'string',
            'life_form' => 'nullable|string|max:255',
            'variegation' => 'nullable|string|max:255',
            'species_id' => 'required|exists:species,id',
            //
        ];
    }
}
