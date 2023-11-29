<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PacientePlanEducacionalController;
use App\Http\Controllers\PacienteTratamientoController;
use App\Http\Controllers\PlanEducacionalController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\TipoTratamientoController;
use App\Http\Controllers\TipoVehiculoController;
use App\Http\Controllers\TratamientoController;
use App\Models\PlanEducacional;

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

});
