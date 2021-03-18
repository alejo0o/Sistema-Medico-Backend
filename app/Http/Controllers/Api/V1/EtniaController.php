<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Etnia;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;

class EtniaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DataCollection(Etnia::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Etnia::create($request->all())->save();
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etnia  $etnia
     * @return \Illuminate\Http\Response
     */
    public function show(Etnia $etnia)
    {
        return $etnia;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etnia  $etnia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etnia $etnia)
    {
        $etnia->etnia = $request->get('etnia');
        $etnia->save();

        return  $etnia;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etnia  $etnia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etnia $etnia)
    {
        $etnia->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
