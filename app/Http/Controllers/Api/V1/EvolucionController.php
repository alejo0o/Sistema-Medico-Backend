<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Evolucion;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EvolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Politica para restringir autorización
        if (Auth::user()->cannot('authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }
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
        //Politica para restringir autorización
        if (Auth::user()->cannot('authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }
        Evolucion::create($request->all())->save();
        return response()->json(
            $request->all(),
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evolucion  $evolucion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Politica para restringir autorización
        if (Auth::user()->cannot('authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }
        return Evolucion::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evolucion  $evolucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Politica para restringir autorización
        if (Auth::user()->cannot('authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }
        $evolucion = Evolucion::findOrFail($id);
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
    public function destroy($id)
    {
        //Politica para restringir autorización
        if (Auth::user()->cannot('authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }
        Evolucion::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
