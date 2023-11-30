<?php

namespace App\Http\Requests\Vehiculo;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'tipo_vehiculo' => 'required',
            'placa' => 'required|unique:vehiculos,placa',
        ];
    }

    public function withValidator($validator)
    {
    }

    public function messages()
    {
        return [
            'tipo_vehiculo.required' => 'El Tipo de Vehículo es Obligatorio',
            'placa.required' => 'La Placa es Obligatoria',
            'placa.unique' => 'La Placa del vehículo ya está registrada en el sistema',
        ];
    }
}
