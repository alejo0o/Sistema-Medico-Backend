<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Capitulo;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;

class CapituloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DataCollection(Capitulo::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Capitulo::create($request->all())->save();
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Capitulo  $capitulo
     * @return \Illuminate\Http\Response
     */
    public function show(Capitulo $capitulo)
    {
        return $capitulo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Capitulo  $capitulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Capitulo $capitulo)
    {
        $capitulo->codigo = $request->get('codigo');
        $capitulo->descripcion = $request->get('descripcion');
        $capitulo->save();
        return  $capitulo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Capitulo  $capitulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capitulo $capitulo)
    {
        $capitulo->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
