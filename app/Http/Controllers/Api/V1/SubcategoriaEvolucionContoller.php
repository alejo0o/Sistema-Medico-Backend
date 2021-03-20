<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SubcategoriaEvolucion;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;

class SubcategoriaEvolucionContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DataCollection(SubcategoriaEvolucion::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SubcategoriaEvolucion::create($request->all())->save();
        return response()->json(
            $request->all(),
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubcategoriaEvolucion  $subcategoriaEvolucion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return SubcategoriaEvolucion::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubcategoriaEvolucion  $subcategoriaEvolucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subcategoriaEvolucion = SubcategoriaEvolucion::findOrFail($id);
        $subcategoriaEvolucion->evolucion_id = $request->get('evolucion_id');
        $subcategoriaEvolucion->subcategoria_id = $request->get('subcategoria_id');
        $subcategoriaEvolucion->save();

        return  $subcategoriaEvolucion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubcategoriaEvolucion  $subcategoriaEvolucion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubcategoriaEvolucion::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
