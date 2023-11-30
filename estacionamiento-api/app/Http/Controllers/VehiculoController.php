<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehiculo\StoreRequest;
use App\Http\Requests\Vehiculo\UpdateRequest;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Vehiculo::with(
            'tipo_vehiculo'
        );

        if ($request->has('search') && !empty(trim($request->input('search')))) {
            $searchTerms = explode(' ', $request->input('search'));

            $query->where(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    if (!empty(trim($term))) {
                        $query->orWhere('placa', 'like', "%{$term}%")
                            ->orWhereHas('tipo_vehiculo', function ($subQuery) use ($term) {
                                $subQuery->where('tipo_vehiculo', 'like', "%{$term}%")
                                    ->orWhere('tarifa', 'like', "%{$term}%");
                            });
                    }
                }
            });
        }

        return [
            'data' => $query->orderByDesc('id')->paginate(12),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $vehiculo = new Vehiculo();
        $vehiculo->placa = $request->placa;
        $vehiculo->tipo_vehiculo_id = $request->tipo_vehiculo['id'];
        $vehiculo->save();

        return [
            'message' => 'El Vehículo fue creado correctamente',
            'status' => true,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show($placa)
    {
        $vehiculo = Vehiculo::select('tipo_vehiculo_id')->where('placa', $placa)->first();
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
    public function update(UpdateRequest $request, $id)
    {
        $vehiculo = Vehiculo::find($id);
        $vehiculo->placa = $request->placa;
        $vehiculo->tipo_vehiculo_id = $request->tipo_vehiculo['id'];
        $vehiculo->save();

        return [
            'message' => 'El Vehículo fue actualizado correctamente',
            'status' => true,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehiculo = Vehiculo::find($id);
        $vehiculo->estado = 0;
        $vehiculo->save();

        return [
            'message' => 'El Vehículo fue desabilitado correctamente',
            'status' => true,
        ];
    }
}
