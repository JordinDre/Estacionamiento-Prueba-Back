<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($placa)
    {
        $vehiculo = Vehiculo::select('tipo_vehiculo_id')->where('placa', $placa)->first();

        // Comprueba si el vehículo tiene un tipo_vehiculo_id asociado y devuelve 1, de lo contrario devuelve 0
        return ['tipo_vehiculo_id' => $vehiculo && $vehiculo->tipo_vehiculo_id ? 1 : 0];
    }


    public function buscar($placa)
    {
        $vehiculos = Vehiculo::select('id', 'tipo_vehiculo_id', 'placa')
            ->where('placa', 'like', "%$placa%")
            ->limit(10)
            ->get();

        return response()->json($vehiculos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        //
    }
}
