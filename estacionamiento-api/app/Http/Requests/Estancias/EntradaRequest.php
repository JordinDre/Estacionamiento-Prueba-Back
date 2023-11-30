<?php

namespace App\Http\Requests\Estancias;

use Illuminate\Foundation\Http\FormRequest;

class EntradaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'placa' => 'required',
        ];
    }

    public function withValidator($validator)
    {
    }

    public function messages()
    {
        return [
            'placa.required' => 'La Placa es Obligatoria',
        ];
    }
}
