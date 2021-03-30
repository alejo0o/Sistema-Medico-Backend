<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\EstadoCivil;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;

class EstadoCivilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EstadoCivil::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        EstadoCivil::create($request->all())->save();
        return response()->json(
            $request->all(),
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EstadoCivil  $estadoCivil
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return EstadoCivil::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EstadoCivil  $estadoCivil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $estadoCivil = EstadoCivil::findOrFail($id);
        $estadoCivil->estado_civil = $request->get('estado_civil');
        $estadoCivil->save();

        return  $estadoCivil;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EstadoCivil  $estadoCivil
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EstadoCivil::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
