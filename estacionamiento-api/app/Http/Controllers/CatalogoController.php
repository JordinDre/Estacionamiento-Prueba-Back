<?php

namespace App\Http\Controllers;

use App\Models\Estancia;
use App\Models\TipoVehiculo;

class CatalogoController extends Controller
{
    public function tipos_vehiculos()
    {
        return TipoVehiculo::select('id', 'tipo_vehiculo')->where('estado', 1)->get();
    }

    public function vehiculos_adentro()
    {
        return Estancia::with('vehiculo:id,placa,tipo_vehiculo_id', 'vehiculo.tipo_vehiculo:id,tarifa')->whereNull('salida')->get();
    }
}
