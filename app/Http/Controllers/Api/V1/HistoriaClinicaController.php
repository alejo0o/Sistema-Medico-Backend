<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\HistoriaClinica;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DataCollection;

class HistoriaClinicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DataCollection(HistoriaClinica::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HistoriaClinica::create($request->all())->save();
        return response()->json(
            $request->all(),
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return HistoriaClinica::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $historiaClinica = HistoriaClinica::findOrFail($id);
        $historiaClinica->paciente_id = $request->get('paciente_id');
        $historiaClinica->alergias = $request->get('alergias');
        $historiaClinica->antecedentes_patologicos = $request->get('antecedentes_patologicos');
        $historiaClinica->antecedentes_quirurgicos = $request->get('antecedentes_quirurgicos');
        $historiaClinica->antecedentes_familiares = $request->get('antecedentes_familiares');
        $historiaClinica->medicamentos_subministrados = $request->get('medicamentos_subministrados');
        $historiaClinica->gestas = $request->get('gestas');
        $historiaClinica->partos = $request->get('partos');
        $historiaClinica->cesareas = $request->get('cesareas');
        $historiaClinica->abortos = $request->get('abortos');
        $historiaClinica->metodo_anticonceptivo = $request->get('metodo_anticonceptivo');
        $historiaClinica->habitos = $request->get('habitos');
        $historiaClinica->save();

        return  $historiaClinica;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HistoriaClinica::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
