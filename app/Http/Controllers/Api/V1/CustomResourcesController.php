<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomResourcesController extends Controller
{
    /*----------Obtener valores de etnias, sangre, educacion y estado civil  */
    public function getEtnia($id)
    {
        $etnia = DB::table('etnias')
            ->join('pacientes', 'etnias.etnia_id', '=', 'pacientes.etnia_id')
            ->select('etnia')
            ->where('pacientes.paciente_id', '=', $id)
            ->get()
            ->first();
        return json_encode($etnia);
    }
    public function getTipoSangre($id)
    {
        $tipo_sangre = DB::table('tipos_de_sangre')
            ->join('pacientes', 'tipos_de_sangre.tipo_de_sangre_id', '=', 'pacientes.tipo_de_sangre_id')
            ->select('tipo_sangre')
            ->where('pacientes.paciente_id', '=', $id)
            ->get()
            ->first();
        return json_encode($tipo_sangre);
    }
    public function getEstadoCivil($id)
    {
        $estado_civil = DB::table('estados_civiles')
            ->join('pacientes', 'estados_civiles.estado_civil_id', '=', 'pacientes.estado_civil_id')
            ->select('estado_civil')
            ->where('pacientes.paciente_id', '=', $id)
            ->get()
            ->first();
        return json_encode($estado_civil);
    }
    public function getNivelDeInstruccion($id)
    {
        $nivel_instruccion = DB::table('niveles_de_instruccion')
            ->join('pacientes', 'niveles_de_instruccion.nivel_de_instruccion_id', '=', 'pacientes.nivel_de_instruccion_id')
            ->select('nivel_de_instruccion')
            ->where('pacientes.paciente_id', '=', $id)
            ->get()
            ->first();
        return json_encode($nivel_instruccion);
    }

    public function getPacientes() //RETORNA UNA CANTIDAD DE PACIENTES PARA EL STATIC GENERATION DE NEXT
    {
        return DB::table('pacientes')->paginate(100);
    }
    //Retorna las historias clinicas por paciente
    public function getHistorialPaciente($id_paciente)
    {
        $historia_clinica = DB::table('historias_clinicas')
            ->join('pacientes', 'historias_clinicas.paciente_id', '=', 'pacientes.paciente_id')
            ->select(
                'pacientes.paciente_id',
                'historias_clinicas.historia_clinica_id',
                'nombres',
                'apellidos',
                'cedula',
                'alergias',
                'antecedentes_patologicos',
                'antecedentes_quirurgicos',
                'antecedentes_familiares',
                'medicamentos_subministrados',
                'gestas',
                'partos',
                'cesareas',
                'abortos',
                'metodo_anticonceptivo',
                'habitos'
            )
            ->where('pacientes.paciente_id', '=', $id_paciente)
            ->get()
            ->first();

        return json_encode($historia_clinica);
    }
    //Retorna las evoluciones de la historia clinica de un paciente
    public function getEvolucionesPaciente($id_paciente)
    {
        $evoluciones = DB::table('pacientes')
            ->join('historias_clinicas', 'historias_clinicas.paciente_id', '=', 'pacientes.paciente_id')
            ->join('evoluciones', 'evoluciones.historia_clinica_id', '=', 'historias_clinicas.historia_clinica_id')
            ->select(
                'pacientes.paciente_id',
                'historias_clinicas.historia_clinica_id',
                'evoluciones.*'
            )
            ->where('pacientes.paciente_id', '=', $id_paciente)
            ->paginate(5);
        return json_encode($evoluciones);
    }
    //Retorna las enfermedades de un paciente en base a su id y evolucion id
    public function getEnfermedadesPacienteEvolucion($id_paciente, $id_evolucion)
    {
        $evoluciones = DB::table('pacientes')
            ->join('historias_clinicas', 'historias_clinicas.paciente_id', '=', 'pacientes.paciente_id')
            ->join('evoluciones', 'evoluciones.historia_clinica_id', '=', 'historias_clinicas.historia_clinica_id')
            ->join('subcategorias_evoluciones', 'subcategorias_evoluciones.evolucion_id', '=', 'evoluciones.evolucion_id')
            ->join('subcategorias', 'subcategorias.subcategoria_id', '=', 'subcategorias_evoluciones.subcategoria_id')
            ->join('categorias', 'categorias.categoria_id', '=', 'subcategorias.categoria_id')
            ->join('capitulos', 'capitulos.capitulo_id', '=', 'categorias.capitulo_id')
            ->select(
                'subcategorias.subcategoria_id',
                'subcategorias.codigo as subcategoria_codigo',
                'subcategorias.descripcion as subcategoria_descripcion',
                'categorias.categoria_id',
                'categorias.codigo as categorias_codigo',
                'categorias.descripcion as categorias_descripcion',
                'capitulos.capitulo_id',
                'capitulos.codigo as capitulo_codigo',
                'capitulos.descripcion as capitulo_descripcion'
            )
            ->where('pacientes.paciente_id', '=', $id_paciente)
            ->where('evoluciones.evolucion_id', '=', $id_evolucion)
            ->get();
        return json_encode($evoluciones);
    }
    //Retorna las Subcategorias en base al codigo de categoria
    public function getSubcategoriasCategoriasCapitulos($codigo_categoria)
    {
        $subcategorias = DB::table('subcategorias')
            ->join('categorias', 'categorias.categoria_id', '=', 'subcategorias.categoria_id')
            ->select(
                'subcategorias.subcategoria_id',
                'subcategorias.codigo as subcategoria_codigo',
                'subcategorias.descripcion as subcategoria_descripcion',
                'categorias.categoria_id',
                'categorias.codigo as categorias_codigo',
                'categorias.descripcion as categorias_descripcion',
            )
            ->where('categorias.codigo', '=', $codigo_categoria)
            ->paginate(10);
        return json_encode($subcategorias);
    }
    //Retorna las categorias en base al codigo de categoria
    public function getCategorias($codigo)
    {
        $categorias = DB::table('categorias')
            ->select('categorias.*')
            ->where('categorias.codigo', 'like', "$codigo%")
            ->paginate(15);

        return json_encode($categorias);
    }
    //Retorna las subcategorias en base al codigo de subcategoria
    public function getSubcategorias($codigo)
    {
        $subcategorias = DB::table('subcategorias')
            ->select('subcategorias.*')
            ->where('subcategorias.codigo', 'like', "$codigo%")
            ->paginate(15);

        return json_encode($subcategorias);
    }
}
