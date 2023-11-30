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
        $tipo_vehiculo = $request->input('tipo_vehiculo');

        $estancias = Estancia::select('id', 'entrada', 'salida', 'vehiculo_id')
            ->with('vehiculo:id,tipo_vehiculo_id,placa', 'vehiculo.tipo_vehiculo:id,tipo_vehiculo,tarifa')
            ->when($fecha_inicial, function ($query) use ($fecha_inicial) {
                return $query->where('entrada', '>=', $fecha_inicial);
            })
            ->when($fecha_final, function ($query) use ($fecha_final) {
                return $query->where('salida', '<=', $fecha_final);
            })
            ->get()
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
            ->values(); // Esto reindexa la colección

        return response()->json($estancias);
    }
}
