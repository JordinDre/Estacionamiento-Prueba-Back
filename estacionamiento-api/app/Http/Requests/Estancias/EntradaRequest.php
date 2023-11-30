<?php

namespace App\Http\Requests\Estancias;

use App\Models\Estancia;
use App\Models\Vehiculo;
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
        $validator->after(function ($validator) {
            $placa = $this->input('placa');
            if ($this->has('placa') && Vehiculo::where('placa', $placa)->first()) {
                $estanciaExistente = Estancia::where('vehiculo_id', Vehiculo::where('placa', $placa)->first()->id)
                    ->whereNull('salida')
                    ->first();

                if ($estanciaExistente) {
                    $validator->errors()->add('placa', 'El carro ya está dentro del parqueo.');
                    return;
                }
            }
        });
    }

    public function messages()
    {
        return [
            'placa.required' => 'La Placa es Obligatoria',
        ];
    }
}
