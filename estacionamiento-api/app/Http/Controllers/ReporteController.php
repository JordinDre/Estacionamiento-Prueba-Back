<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Estancia;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function pagos_residentes(Request $request)
    {
        $fecha_inicial = $request->input('fecha_inicial');
        $fecha_final = $request->input('fecha_final');
        $tipo_vehiculo_id = $request->input('tipo_vehiculo');

        $estanciasQuery = Estancia::select('id', 'entrada', 'salida', 'vehiculo_id')
            ->with('vehiculo:id,tipo_vehiculo_id,placa', 'vehiculo.tipo_vehiculo:id,tipo_vehiculo,tarifa');

        if ($fecha_inicial) {
            $estanciasQuery->where('entrada', '>=', $fecha_inicial);
        }

        if ($fecha_final) {
            $estanciasQuery->where('salida', '<=', $fecha_final);
        }

        if ($tipo_vehiculo_id) {
            $estanciasQuery->whereHas('vehiculo', function ($query) use ($tipo_vehiculo_id) {
                $query->where('tipo_vehiculo_id', $tipo_vehiculo_id);
            });
        }

        $estancias = $estanciasQuery->get()
            ->mapToGroups(function ($estancia) {
                $entrada = Carbon::parse($estancia->entrada);
                $salida = Carbon::parse($estancia->salida);
                $estancia->duracion_en_minutos = $entrada->diffInMinutes($salida, false);

                return [$estancia->vehiculo_id => $estancia];
            })
            ->map(function ($estanciasPorVehiculo) {
                $duracionTotal = $estanciasPorVehiculo->sum('duracion_en_minutos');
                $vehiculo = $estanciasPorVehiculo->first()->vehiculo;

                return [
                    'placa' => $vehiculo->placa,
                    'tipo_vehiculo' => $vehiculo->tipo_vehiculo->tipo_vehiculo,
                    'tarifa' => $vehiculo->tipo_vehiculo->tarifa,
                    'duracion_total_minutos' => $duracionTotal,
                ];
            })
            ->values();

        return response()->json($estancias);
    }
}
