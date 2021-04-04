<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
    public function getCategorias($busqueda)
    {
        $categorias = DB::table('categorias')
            ->select('categorias.*')
            ->where('categorias.codigo', 'ilike', "$busqueda%")
            ->orWhere('categorias.descripcion', 'ilike', "%$busqueda%")
            ->paginate(15);

        return json_encode($categorias);
    }
    //Retorna las subcategorias en base al codigo o nombre de subcategoria
    public function getSubcategorias($busqueda)
    {
        //$busqueda = Str::ascii($busqueda);
        $subcategorias = DB::table('subcategorias')
            ->select('subcategorias.*')
            ->where('subcategorias.codigo', 'ilike', "$busqueda%")
            ->orWhere('subcategorias.descripcion', 'ilike', "%$busqueda%")
            ->paginate(15);

        return json_encode($subcategorias);
    }
    //Retorna la busqueda de pacientes por cédula o por nombre
    public function getPacientesxCedulaoNombre($busqueda)
    {

        $pacientes = DB::table('pacientes')
            ->select('pacientes.*')
            ->where('pacientes.cedula', 'ilike', "$busqueda%")
            ->orWhereRaw("concat(trim(pacientes.nombres),' ',trim(pacientes.apellidos)) ilike ?", ["%$busqueda%"])
            ->paginate(5);

        return json_encode($pacientes);
    }
}
