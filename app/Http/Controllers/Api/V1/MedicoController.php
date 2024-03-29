<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;
use Illuminate\Support\Facades\DB;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicos = DB::table("medicos")
            ->select('*')
            ->orderBy('apellidos', 'asc')
            ->paginate(5);
        return json_encode($medicos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Medico::create($request->all())->save();
        return response()->json(
            $request->all(),
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Medico::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $medico = Medico::findOrFail($id);
        $medico->consultorio_id = $request->get('consultorio_id');
        $medico->cedula = $request->get('cedula');
        $medico->nombres = $request->get('nombres');
        $medico->apellidos = $request->get('apellidos');
        $medico->telefono = $request->get('telefono');
        $medico->email = $request->get('email');
        $medico->especialidades = $request->get('especialidades');
        $medico->save();

        return  $medico;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Medico::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
