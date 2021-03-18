<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('v1/capitulos', App\Http\Controllers\Api\V1\CapituloController::class);
Route::apiResource('v1/categorias', App\Http\Controllers\Api\V1\CategoriaController::class);
Route::apiResource('v1/citas', App\Http\Controllers\Api\V1\CitaController::class);
Route::apiResource('v1/consultorios', App\Http\Controllers\Api\V1\ConsultorioController::class);
Route::apiResource('v1/especialidades', App\Http\Controllers\Api\V1\EspecialidadController::class);
Route::apiResource('v1/estadosciviles', App\Http\Controllers\Api\V1\EstadoCivilController::class);
Route::apiResource('v1/etnias', App\Http\Controllers\Api\V1\EtniaController::class);
Route::apiResource('v1/evoluciones', App\Http\Controllers\Api\V1\EvolucionController::class);
Route::apiResource('v1/historiasclinicas', App\Http\Controllers\Api\V1\HistoriaClinicaController::class);
Route::apiResource('v1/inventario', App\Http\Controllers\Api\V1\InventarioController::class);
Route::apiResource('v1/medicos', App\Http\Controllers\Api\V1\MedicoController::class);
Route::apiResource('v1/nivelesdeinstruccion', App\Http\Controllers\Api\V1\NivelDeInstruccionController::class);
Route::apiResource('v1/pacientes', App\Http\Controllers\Api\V1\PacienteController::class);
Route::apiResource('v1/servicios', App\Http\Controllers\Api\V1\ServicioController::class);
Route::apiResource('v1/subcategorias', App\Http\Controllers\Api\V1\SubcategoriaController::class);
Route::apiResource('v1/tiposdesangre', App\Http\Controllers\Api\V1\TipoDeSangreController::class);
Route::apiResource('v1/tratamientos', App\Http\Controllers\Api\V1\TratamientoController::class);
