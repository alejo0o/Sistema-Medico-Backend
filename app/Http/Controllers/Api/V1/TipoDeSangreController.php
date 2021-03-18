<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\TipoDeSangre;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;


class TipoDeSangreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DataCollection(TipoDeSangre::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TipoDeSangre::create($request->all())->save();
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoDeSangre  $tipoDeSangre
     * @return \Illuminate\Http\Response
     */
    public function show(TipoDeSangre $tipoDeSangre)
    {
        return $tipoDeSangre;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoDeSangre  $tipoDeSangre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoDeSangre $tipoDeSangre)
    {
        $tipoDeSangre->tipo_sangre = $request->get('tipo_sangre');
        $tipoDeSangre->save();

        return  $tipoDeSangre;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoDeSangre  $tipoDeSangre
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoDeSangre $tipoDeSangre)
    {
        $tipoDeSangre->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
