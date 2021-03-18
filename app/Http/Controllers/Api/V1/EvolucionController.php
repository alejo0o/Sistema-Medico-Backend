<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Evolucion;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;

class EvolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DataCollection(Evolucion::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Evolucion::create($request->all())->save();
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evolucion  $evolucion
     * @return \Illuminate\Http\Response
     */
    public function show(Evolucion $evolucion)
    {
        return $evolucion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evolucion  $evolucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evolucion $evolucion)
    {
        $evolucion->historia_clinica_id = $request->get('historia_clinica_id');
        $evolucion->fecha = $request->get('fecha');
        $evolucion->motivo_consulta = $request->get('motivo_consulta');
        $evolucion->fecha_ultima_menstruacion = $request->get('fecha_ultima_menstruacion');
        $evolucion->procedimiento = $request->get('procedimiento');
        $evolucion->diagnostico = $request->get('diagnostico');
        $evolucion->tratamiento = $request->get('tratamiento');
        $evolucion->proximo_control = $request->get('proximo_control');
        $evolucion->save();

        return  $evolucion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evolucion  $evolucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evolucion $evolucion)
    {
        $evolucion->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
