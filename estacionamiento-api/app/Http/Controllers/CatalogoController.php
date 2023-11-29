<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aldea;
use App\Models\Banco;
use App\Models\Marca;
use App\Models\Tienda;
use App\Models\Producto;
use App\Models\TipoPago;
use App\Models\Categoria;
use App\Models\Municipio;
use App\Models\Constantes;
use App\Models\CuentaBancaria;
use App\Models\Departamento;
use App\Models\EjercicioActivo;
use App\Models\EjercicioPasivo;
use App\Models\Estancia;
use App\Models\FNP;
use App\Models\Jugada;
use App\Models\MedioFisico;
use App\Models\PlanEducacional;
use App\Models\Presentacion;
use App\Models\TipoComercio;
use App\Models\TipoCorriente;
use App\Models\TipoTratamiento;
use App\Models\TipoVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogoController extends Controller
{
    public function tipos_vehiculos()
    {
        return TipoVehiculo::select('id', 'tipo_vehiculo')->get();
    }

    public function vehiculos_adentro()
    {
        return Estancia::with('vehiculo:id,placa,tipo_vehiculo_id', 'vehiculo.tipo_vehiculo:id,tarifa')->whereNull('salida')->get();
    }

}
