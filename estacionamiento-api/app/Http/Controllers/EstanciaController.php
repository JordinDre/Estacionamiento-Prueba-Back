<?php

namespace App\Http\Controllers;

use App\Models\Estancia;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EstanciaController extends Controller
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
        $vehiculo = Vehiculo::where('placa', $request->placa)->first();

        if ($vehiculo) {
            $estancia = new Estancia();
            $estancia->entrada = Carbon::now()->format('Y-m-d H:i:s');
            $estancia->vehiculo_id = $vehiculo->id;
            $estancia->save();
        } else {
            $nuevo_vehiculo = new Vehiculo();
            $nuevo_vehiculo->placa = $request->placa;
            $nuevo_vehiculo->tipo_vehiculo_id = $request->tipo_vehiculo['id'];
            $nuevo_vehiculo->save();

            $estancia = new Estancia();
            $estancia->entrada = Carbon::now()->format('Y-m-d H:i:s');
            $estancia->vehiculo_id = $nuevo_vehiculo->id;
            $estancia->save();
        }

        return [
            'message' => 'Entrada Guardada Correctamente',
            'status' => true,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Estancia $estancia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estancia $estancia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estancia $estancia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estancia $estancia)
    {
        //
    }
}
