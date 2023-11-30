<?php

namespace App\Http\Controllers;

use App\Http\Requests\Estancias\EntradaRequest;
use App\Models\Estancia;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EstanciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Estancia::with(
            'vehiculo:id,placa,tipo_vehiculo_id',
            'vehiculo.tipo_vehiculo:id,tipo_vehiculo,tarifa'
        );

        if ($request->has('search') && !empty(trim($request->input('search')))) {
            $searchTerms = explode(' ', $request->input('search'));

            $query->where(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    if (!empty(trim($term))) {
                        $query->where(function ($subQuery) use ($term) {
                            $subQuery->orWhere('entrada', 'like', "%{$term}%");
                            $subQuery->orWhere('salida', 'like', "%{$term}%");
                            $subQuery->orWhereHas('vehiculo', function ($q) use ($term) {
                                $q->where('placa', 'like', "%{$term}%");
                            });
                            $subQuery->orWhereHas('vehiculo.tipo_vehiculo', function ($q) use ($term) {
                                $q->where('tipo_vehiculo', 'like', "%{$term}%");
                            });
                            $subQuery->orWhereHas('vehiculo.tipo_vehiculo', function ($q) use ($term) {
                                $q->where('tarifa', 'like', "%{$term}%");
                            });
                        });
                    }
                }
            });
        }

        return [
            'data' => $query->orderBy('salida')->paginate(20),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntradaRequest $request)
    {
        $vehiculo = Vehiculo::where('placa', $request->placa)->first();

        if ($vehiculo) {
            $estancia = new Estancia();
            $estancia->entrada = Carbon::now()->format('Y-m-d H:i:s');
            $estancia->vehiculo_id = $vehiculo->id;
            $estancia->save();
            return [
                'message' => 'Registro de Entrada para Vehiculo con Placa ' . $request->placa,
                'status' => true,
            ];
        } else {
            $nuevo_vehiculo = new Vehiculo();
            $nuevo_vehiculo->placa = $request->placa;
            $nuevo_vehiculo->tipo_vehiculo_id = $request->tipo_vehiculo['id'];
            $nuevo_vehiculo->save();

            $estancia = new Estancia();
            $estancia->entrada = Carbon::now()->format('Y-m-d H:i:s');
            $estancia->vehiculo_id = $nuevo_vehiculo->id;
            $estancia->save();

            return [
                'message' => 'Guardado Y Registro de Entrada para Vehiculo con Placa ' . $request->placa,
                'status' => true,
            ];
        }
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
    public function update(Request $request, $id)
    {
        $estancia = Estancia::find($id);
        $estancia->salida = Carbon::now()->format('Y-m-d H:i:s');
        $estancia->save();

        return [
            'message' => 'Registrada la Salida para Vehiculo',
            'status' => true,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estancia $estancia)
    {
        //
    }
}
