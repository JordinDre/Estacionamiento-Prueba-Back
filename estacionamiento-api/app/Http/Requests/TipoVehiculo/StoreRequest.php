<?php

namespace App\Http\Requests\TipoVehiculo;

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
            'tarifa' => 'required|numeric',
            // Resto de tus reglas...
        ];
    }

    public function withValidator($validator)
    {
    }

    public function messages()
    {
        return [
            'tipo_vehiculo.required' => 'El Tipo de Vehículo es Obligatorio',
            'tarifa.required' => 'La Tarifa es Obligatoria',
            'tarifa.numeric' => 'La Tarifa debe ser un valor numérico',
        ];
    }
}
