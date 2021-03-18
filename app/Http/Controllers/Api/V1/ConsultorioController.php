<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Consultorio;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;

class ConsultorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DataCollection(Consultorio::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Consultorio::create($request->all())->save();
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultorio  $consultorio
     * @return \Illuminate\Http\Response
     */
    public function show(Consultorio $consultorio)
    {
        return $consultorio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultorio  $consultorio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultorio $consultorio)
    {
        $consultorio->nombre = $request->get('nombre');
        $consultorio->descripcion = $request->get('descripcion');
        $consultorio->vision = $request->get('vision');
        $consultorio->mision = $request->get('mision');
        $consultorio->ruc = $request->get('ruc');
        $consultorio->direccion = $request->get('direccion');
        $consultorio->telefono = $request->get('telefono');
        $consultorio->logo = $request->get('logo');
        $consultorio->correo = $request->get('correo');
        $consultorio->red_social1 = $request->get('red_social1');
        $consultorio->red_social2 = $request->get('red_social2');
        $consultorio->save();

        return  $consultorio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultorio  $consultorio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultorio $consultorio)
    {
        $consultorio->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
