<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;


class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DataCollection(Subcategoria::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Subcategoria::create($request->all())->save();
        return response()->json(
            $request->all(),
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategoria  $subcategoria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Subcategoria::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategoria  $subcategoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $subcategoria->categoria_id = $request->get('categoria_id');
        $subcategoria->codigo = $request->get('codigo');
        $subcategoria->descripcion = $request->get('descripcion');
        $subcategoria->save();

        return  $subcategoria;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategoria  $subcategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subcategoria::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
