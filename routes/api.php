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
//-------------------Recursos de api
Route::apiResource('v1/capitulos', App\Http\Controllers\Api\V1\CapituloController::class)->middleware('auth:api');
Route::apiResource('v1/categorias', App\Http\Controllers\Api\V1\CategoriaController::class)->middleware('auth:api');
Route::apiResource('v1/citas', App\Http\Controllers\Api\V1\CitaController::class)->middleware('auth:api');
Route::apiResource('v1/consultorios', App\Http\Controllers\Api\V1\ConsultorioController::class)->middleware('auth:api');
Route::apiResource('v1/especialidades', App\Http\Controllers\Api\V1\EspecialidadController::class)->middleware('auth:api');
Route::apiResource('v1/estadosciviles', App\Http\Controllers\Api\V1\EstadoCivilController::class)->middleware('auth:api');
Route::apiResource('v1/etnias', App\Http\Controllers\Api\V1\EtniaController::class)->middleware('auth:api');
Route::apiResource('v1/evoluciones', App\Http\Controllers\Api\V1\EvolucionController::class)->middleware('auth:api');
Route::apiResource('v1/generos', App\Http\Controllers\Api\V1\GeneroContoller::class)->middleware('auth:api');
Route::apiResource('v1/historiasclinicas', App\Http\Controllers\Api\V1\HistoriaClinicaController::class)->middleware('auth:api');
Route::apiResource('v1/inventario', App\Http\Controllers\Api\V1\InventarioController::class)->middleware('auth:api');
Route::apiResource('v1/medicos', App\Http\Controllers\Api\V1\MedicoController::class)->middleware('auth:api');
Route::apiResource('v1/nivelesdeinstruccion', App\Http\Controllers\Api\V1\NivelDeInstruccionController::class)->middleware('auth:api');
Route::apiResource('v1/pacientes', App\Http\Controllers\Api\V1\PacienteController::class)->middleware('auth:api');
Route::apiResource('v1/servicios', App\Http\Controllers\Api\V1\ServicioController::class)->middleware('auth:api');
Route::apiResource('v1/subcategorias', App\Http\Controllers\Api\V1\SubcategoriaController::class)->middleware('auth:api');
Route::apiResource('v1/tiposdesangre', App\Http\Controllers\Api\V1\TipoDeSangreController::class)->middleware('auth:api');
Route::apiResource('v1/tratamientos', App\Http\Controllers\Api\V1\TratamientoController::class)->middleware('auth:api');

//---------------------Recursos personalizados de api------------------------------//
Route::get('/v1/getpacientes', [App\Http\Controllers\Api\V1\CustomResourcesController::class, 'getPacientes'])->middleware('auth:api');
Route::get('v1/historiaclinicapaciente/{id}', [App\Http\Controllers\Api\V1\CustomResourcesController::class, 'getHistorialPaciente'])->middleware('auth:api');
Route::get('v1/evolucionespaciente/{id}', [App\Http\Controllers\Api\V1\CustomResourcesController::class, 'getEvolucionesPaciente'])->middleware('auth:api');
Route::get('v1/categoriascodigo/{busqueda}', [App\Http\Controllers\Api\V1\CustomResourcesController::class, 'getCategorias'])->middleware('auth:api');
Route::get('v1/subcategoriascodigo/{busqueda}', [App\Http\Controllers\Api\V1\CustomResourcesController::class, 'getSubcategorias'])->middleware('auth:api');
Route::get('v1/getpacientesbusqueda/{busqueda}', [App\Http\Controllers\Api\V1\CustomResourcesController::class, 'getPacientesxCedulaoNombre'])->middleware('auth:api');
Route::get('v1/existehistorial/{id}', [App\Http\Controllers\Api\V1\CustomResourcesController::class, 'getHistorial'])->middleware('auth:api');
//JWT AUTH


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\Api\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\Api\AuthController::class, 'me']);
});

Route::any('{any}', function () {
    return response()->json([
        'status' => 'error',
        'message' => 'Resource not found'
    ], 404);
})->where('any', '.*');
