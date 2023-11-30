<?php

namespace App\Http\Requests\Vehiculo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $vehiculoId = $this->route('vehiculo'); 

        return [
            'tipo_vehiculo' => 'required',
            'placa' => 'required|unique:vehiculos,placa,' . $vehiculoId,
        ];
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
