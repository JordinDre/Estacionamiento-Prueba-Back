<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegistroRequest;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /* Validamos el request con RegistroRequest */
    public function register(RegisterRequest $request)
    {
        /* Si pasa el Request entonces se crea el Usuario */
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole('administrador');

        // Retornar una respuesta
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }


    /* Validamos el request con LoginRequest */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        /* Si pasa el Request entonces se crea el Usuario */
        if (!Auth::attempt($data)) {
            throw ValidationException::withMessages([
                'errors' => 'El email o password son incorrectos'
            ]);
        }

        $user = Auth::user();
        // Si quieres obtener solo los nombres de los permisos en lugar de los objetos completos:
        $permissionNames = $user->getPermissionNames(); // Esto devolverá una colección de nombres de permisos

        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user,
            'role' => $user->roles->first()->name,
            'permissions' => $permissionNames
        ];
    }


    /* Validamos el request con LoginRequest */
    public function logout(Request $request)
    {
        PersonalAccessToken::findToken($request->bearerToken())->delete();
        Cookie::forget('laravel_session');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return [
            'user' => null
        ];
    }
}
