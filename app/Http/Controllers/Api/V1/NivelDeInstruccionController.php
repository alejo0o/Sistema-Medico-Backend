<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\NivelDeInstruccion;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;

class NivelDeInstruccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DataCollection(NivelDeInstruccion::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        NivelDeInstruccion::create($request->all())->save();
        return response()->json(
            $request->all(),
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NivelDeInstruccion  $nivelDeInstruccion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return NivelDeInstruccion::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NivelDeInstruccion  $nivelDeInstruccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nivelDeInstruccion = NivelDeInstruccion::findOrFail($id);
        $nivelDeInstruccion->nivel_de_instruccion = $request->get('nivel_de_instruccion');
        $nivelDeInstruccion->save();

        return  $nivelDeInstruccion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NivelDeInstruccion  $nivelDeInstruccion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        NivelDeInstruccion::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
