<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\EstanciaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\TipoVehiculoController;
use App\Http\Controllers\VehiculoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth
Route::post('registro', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('tipos_vehiculos', TipoVehiculoController::class);
    Route::resource('vehiculos', VehiculoController::class);
    Route::resource('estancias', EstanciaController::class);
    Route::get('vehiculos/buscar/{placa}', [VehiculoController::class, 'buscar']);

    /* CATALOGO */
    Route::prefix('catalogo')->group(function () {
        Route::get('/tipos_vehiculos',  [CatalogoController::class, 'tipos_vehiculos']);
        Route::get('/vehiculos_adentro',  [CatalogoController::class, 'vehiculos_adentro']);
    });

    Route::prefix('reporte')->group(function () {
        Route::get('/pagos_residentes',  [ReporteController::class, 'pagos_residentes']);
    });
});
