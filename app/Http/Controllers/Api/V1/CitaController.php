<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas = DB::table('citas')
            ->select(
                'citas.*',
                'pacientes.nombres as paciente_nombres',
                'pacientes.apellidos as paciente_apellidos',
                'medicos.nombres as medico_nombres',
                'medicos.apellidos as medico_apellidos'
            )
            ->join('pacientes', 'citas.paciente_id', '=', 'pacientes.paciente_id')
            ->join('medicos', 'citas.medico_id', '=', 'medicos.medico_id')
            ->paginate(5);
        return json_encode($citas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cita::create($request->all())->save();
        return response()->json(
            $request->all(),
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cita = DB::table('citas')
            ->select(
                'citas.*',
                'pacientes.nombres as paciente_nombres',
                'pacientes.apellidos as paciente_apellidos',
                'medicos.nombres as medico_nombres',
                'medicos.apellidos as medico_apellidos'
            )
            ->join('pacientes', 'citas.paciente_id', '=', 'pacientes.paciente_id')
            ->join('medicos', 'citas.medico_id', '=', 'medicos.medico_id')
            ->where('citas.cita_id', '=', $id)
            ->first();
        return json_encode($cita);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->paciente_id = $request->get('paciente_id');
        $cita->medico_id = $request->get('medico_id');
        $cita->fecha = $request->get('fecha');
        $cita->hora = $request->get('hora');
        $cita->motivo_cita = $request->get('motivo_cita');
        $cita->save();

        return  $cita;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cita::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
