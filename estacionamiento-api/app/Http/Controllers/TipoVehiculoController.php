<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoVehiculo\StoreRequest;
use App\Http\Requests\TipoVehiculo\UpdateRequest;
use App\Models\TipoVehiculo;
use Illuminate\Http\Request;

class TipoVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TipoVehiculo::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $tipo_vehiculo = new TipoVehiculo();
        $tipo_vehiculo->tipo_vehiculo = $request->tipo_vehiculo;
        $tipo_vehiculo->tarifa = $request->tarifa;
        $tipo_vehiculo->save();

        return [
            'message' => 'El Tipo de Vehículo fue creado correctamente',
            'status' => true,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $tipo_vehiculo = TipoVehiculo::find($id);
        $tipo_vehiculo->tipo_vehiculo = $request->tipo_vehiculo;
        $tipo_vehiculo->tarifa = $request->tarifa;
        $tipo_vehiculo->estado = 1;
        $tipo_vehiculo->save();

        return [
            'message' => 'El Tipo de Vehículo fue actualizado correctamente',
            'status' => true,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipo_vehiculo = TipoVehiculo::find($id);
        $tipo_vehiculo->estado = 0;
        $tipo_vehiculo->save();

        return [
            'message' => 'El Tipo de Vehículo fue desabilitado correctamente',
            'status' => true,
        ];
    }
}
