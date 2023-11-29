<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegistroRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->symbols()->numbers()],
        ];
    }

    public function messages()
    {
        return [            
            'email.required' => 'El Email es Obligatorio',
            'email.email' => 'El Email no es válido',
            'email.unique' => 'El Email ya está registrado',

            'password' => 'La Contraseña debe contener al menos 8 caracteres, un simbolo y un número',
            'password.required' => 'La Contraseña es Obligatoria',
            'password.confirmed' => 'Debe de Confirmar la Contraseña',
        ];
    }
}
