<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Genero::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Genero::create($request->all())->save();
        return response()->json(
            $request->all(),
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Genero::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $genero = Genero::findOrFail($id);
        $genero->genero = $request->get('genero');
        $genero->save();

        return  $genero;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genero::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
