<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;


class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DataCollection(Paciente::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Paciente::create($request->all())->save();
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        return $paciente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        $paciente->tipo_de_sangre_id = $request->get('tipo_de_sangre_id');
        $paciente->etnia_id = $request->get('etnia_id');
        $paciente->nivel_de_instruccion_id = $request->get('nivel_de_instruccion_id');
        $paciente->estado_civil_id = $request->get('estado_civil_id');
        $paciente->nombres = $request->get('nombres');
        $paciente->apellidos = $request->get('apellidos');
        $paciente->cedula = $request->get('cedula');
        $paciente->fechanacimiento = $request->get('fechanacimiento');
        $paciente->lugarnacimiento = $request->get('lugarnacimiento');
        $paciente->direccion = $request->get('direccion');
        $paciente->telefono = $request->get('telefono');
        $paciente->ocupacion = $request->get('ocupacion');
        $paciente->numero_hijos = $request->get('numero_hijos');
        $paciente->contacto_emergencia_nombre = $request->get('contacto_emergencia_nombre');
        $paciente->contacto_emergencia_telefono = $request->get('contacto_emergencia_telefono');

        $paciente->save();

        return  $paciente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
