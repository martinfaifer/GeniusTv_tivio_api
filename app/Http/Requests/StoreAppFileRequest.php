<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file' => ["required"],
            'description' => ['nullable', 'string', 'max:255'],
            'app_category_id' => ['required', 'exists:app_categories,id']
        ];
    }

    public function messages()
    {
        return [
            'file.required' => "Nahrajte soubor",
            'description.string' => "Neplatný formát",
            'description.max' => "Maximální počet znaků je 255",
            'app_category_id.required' => "Vyberte kategorii",
            'app_category_id.exists' => "Nexxistující kategorie"
        ];
    }
}
