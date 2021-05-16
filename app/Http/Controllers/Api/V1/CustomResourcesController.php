<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\CitaMail;
use App\Mail\CitasEmail;
use App\Mail\CredencialesEmail;
use App\Models\Cita;
use App\Models\User;
use App\Notifications\CitaAlerta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class CustomResourcesController extends Controller
{
    public function getPacientes() //RETORNA UNA CANTIDAD DE PACIENTES PARA EL STATIC GENERATION DE NEXT
    {
        //Politica para restringir autorización
        if (Auth::user()->cannot('authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }


        return DB::table('pacientes')->paginate(100);
    }
    //Retorna todos los  meidicos
    public function getAllMedicos()
    {
        return DB::table('medicos')->get()->all();
    }
    //Retorna las historias clinicas por paciente
    public function getHistorialPaciente($id_paciente)
    {

        //Politica para restringir autorización
        if (Auth::user()->cannot('authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

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

        //Politica para restringir autorización
        if (Auth::user()->cannot('authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $evoluciones = DB::table('pacientes')
            ->join('historias_clinicas', 'historias_clinicas.paciente_id', '=', 'pacientes.paciente_id')
            ->join('evoluciones', 'evoluciones.historia_clinica_id', '=', 'historias_clinicas.historia_clinica_id')
            ->select(
                'pacientes.paciente_id',
                'historias_clinicas.historia_clinica_id',
                'evoluciones.*'
            )
            ->where('pacientes.paciente_id', '=', $id_paciente)
            ->orderBy('evoluciones.fecha', 'asc')
            ->paginate(5);
        return json_encode($evoluciones);
    }
    //Retorna las categorias en base al codigo de categoria
    public function getCategorias($busqueda)
    {

        //Politica para restringir autorización
        if (Auth::user()->cannot('authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

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
        //Politica para restringir autorización
        if (Auth::user()->cannot('authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

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
            ->select('pacientes.*', 'estado_civil', 'etnia', 'genero', 'nivel_de_instruccion', 'tipo_sangre')
            ->join('estados_civiles', 'pacientes.estado_civil_id', '=', 'estados_civiles.estado_civil_id')
            ->join('niveles_de_instruccion', 'pacientes.nivel_de_instruccion_id', '=', 'niveles_de_instruccion.nivel_de_instruccion_id')
            ->join('tipos_de_sangre', 'pacientes.tipo_de_sangre_id', '=', 'tipos_de_sangre.tipo_de_sangre_id')
            ->join('etnias', 'pacientes.etnia_id', '=', 'etnias.etnia_id')
            ->join('generos', 'pacientes.genero_id', '=', 'generos.genero_id')
            ->where('pacientes.cedula', 'ilike', "$busqueda%")
            ->orWhereRaw("concat(trim(pacientes.nombres),' ',trim(pacientes.apellidos)) ilike ?", ["%$busqueda%"])
            ->paginate(5);

        return json_encode($pacientes);
    }
    //Revisa si un paciente posee un historial clinico o no
    public function getHistorial($id_paciente)
    {

        $historia_clinica = DB::table('historias_clinicas')
            ->join('pacientes', 'historias_clinicas.paciente_id', '=', 'pacientes.paciente_id')
            ->select(
                'apellidos',
            )
            ->where('pacientes.paciente_id', '=', $id_paciente)
            ->get()
            ->first();



        return $historia_clinica ? true : false;
    }
    //Retorna las citas segun la fecha
    public function getCitasxFecha($fecha, $medico_cedula)
    {

        $citas = DB::table('citas')
            ->select(
                'citas.*',
                'pacientes.nombres as paciente_nombres',
                'pacientes.apellidos as paciente_apellidos',
                'pacientes.email as paciente_correo',
                'pacientes.telefono as paciente_numero',
                'medicos.nombres as medico_nombres',
                'medicos.apellidos as medico_apellidos',
                'medicos.email as medico_correo',
                'medicos.telefono as medico_numero'
            )
            ->join('pacientes', 'citas.paciente_id', '=', 'pacientes.paciente_id')
            ->join('medicos', 'citas.medico_id', '=', 'medicos.medico_id')
            ->whereDate('fecha', '=', $fecha)
            ->where('medicos.cedula', '=', $medico_cedula)
            ->orderBy('citas.hora', 'asc')
            ->get();

        return json_encode($citas);
    }
    //Retorna la busqueda de medicos por cédula o por nombre
    public function getMedicosxCedulaoNombre($busqueda)
    {
        $medicos = DB::table('medicos')
            ->select('medicos.*')
            ->where('medicos.cedula', 'ilike', "$busqueda%")
            ->orWhereRaw("concat(trim(medicos.nombres),' ',trim(medicos.apellidos)) ilike ?", ["%$busqueda%"])
            ->orderBy('medicos.nombres', 'asc')
            ->paginate(5);

        return json_encode($medicos);
    }
    public function getCitasxMes($mes, $medico_cedula)
    {

        $citas = DB::table('citas')
            ->select(
                'citas.*',
                'pacientes.nombres as paciente_nombres',
                'pacientes.apellidos as paciente_apellidos',
                'pacientes.email as paciente_correo',
                'pacientes.telefono as paciente_numero',
                'medicos.nombres as medico_nombres',
                'medicos.apellidos as medico_apellidos',
                'medicos.email as medico_correo',
                'medicos.telefono as medico_numero'
            )
            ->join('pacientes', 'citas.paciente_id', '=', 'pacientes.paciente_id')
            ->join('medicos', 'citas.medico_id', '=', 'medicos.medico_id')
            ->whereMonth('fecha', '=', $mes)
            ->where('medicos.cedula', '=', $medico_cedula)
            ->orderBy('citas.hora', 'asc')
            ->get();

        return json_encode($citas);
    }
    public function sendiCitaConfirmacion(Request $request)
    {
        $variable = request(['correo', 'nombre_completo', 'hora', 'fecha', 'medico']);
        try {
            Mail::to($variable['correo'])->send(new CitasEmail($variable));
            return response()->json(
                ['message' => 'correo enviado'],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                ['error' => 'Error al enviar el correo.'],
                500
            );
        }
    }
    public function sendiCitaConfirmacionSMS(Request $request)
    {
        $variable = request(['telefono', 'nombre_completo', 'hora', 'fecha', 'medico']);
        try {
            Notification::route('nexmo', $variable['telefono'])->notify(new CitaAlerta($variable));
            return response()->json(
                ['message' => 'SMS enviado'],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                ['error' => 'Error al enviar el SMS.'],
                500
            );
        }
    }
    public function searchEspecialidad($busqueda)
    {
        $especialidaes = DB::table('especialidades')
            ->select('*')
            ->where('especialidad', 'ilike', "$busqueda%")
            ->paginate(8);
        return json_encode($especialidaes);
    }
    //Retorna la busqueda de tratamientos por nombre
    public function getTratamientosxNombre($busqueda)
    {
        $tratamientos = DB::table('tratamientos')
            ->select('tratamientos.*')
            ->where('tratamientos.nombre', 'ilike', "%$busqueda%")
            ->orderBy('tratamientos.nombre', 'asc')
            ->paginate(5);

        return json_encode($tratamientos);
    }
    //Retorna la busqueda de materiales por nombre
    public function getMaterialesxNombre($busqueda)
    {
        $inventario = DB::table('inventario')
            ->select('inventario.*')
            ->where('inventario.nombre', 'ilike', "%$busqueda%")
            ->orderBy('inventario.nombre', 'asc')
            ->paginate(5);

        return json_encode($inventario);
    }
    //Retorna la información del paciente y su evolución en base al id de su evolución
    public function getPaicientexEvolucion($id)
    {
        //Politica para restringir autorización
        if (Auth::user()->cannot('authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $paciente_evolucion = DB::table('evoluciones')
            ->select(
                'pacientes.nombres',
                'pacientes.apellidos',
                'pacientes.fechanacimiento',
                'generos.genero',
                'generos.genero_id',
                'pacientes.cedula',
                'evoluciones.medicacion',
                'evoluciones.indicaciones',
                'evoluciones.diagnostico',
                'evoluciones.fecha'
            )
            ->join('historias_clinicas', 'evoluciones.historia_clinica_id', '=', 'historias_clinicas.historia_clinica_id')
            ->join('pacientes', 'historias_clinicas.paciente_id', '=', 'pacientes.paciente_id')
            ->join('generos', 'pacientes.genero_id', '=', 'generos.genero_id')
            ->where('evoluciones.evolucion_id', '=', $id)
            ->first();
        return json_encode($paciente_evolucion);
    }
    //Obtiene los datos del médico por la cédula
    public function getMedicoxCedula($cedula)
    {
        $medico = DB::table('medicos')
            ->select(
                '*'
            )
            ->where('cedula', '=', $cedula)
            ->first();
        return json_encode($medico);
    }
    //Revisa si existe una cita en un hora especificada antes de crear otra
    public function crearCitaComprobacion(Request $request)
    {
        $citas = DB::table('citas')
            ->select(
                '*'
            )
            ->where('medico_id', '=', $request->get('medico_id'))
            ->whereDate('fecha', '=', $request->get('fecha'))
            ->whereTime('hora', '=', $request->get('hora'))
            ->first();

        if ($citas) {
            return response()->json(
                ['citaexiste' => 'Ya existe una cita programada a esa hora.'],
                500
            );
        }
        Cita::create($request->all())->save();
        return response()->json(
            $request->all(),
            201
        );
    }
    //Revisa si existe una cita en un hora especificada antes de editarla
    public function editarCitaComprobacion(Request $request, $id)
    {
        $citas = DB::table('citas')
            ->select(
                '*'
            )
            ->where('cita_id', '!=', $id)
            ->where('medico_id', '=', $request->get('medico_id'))
            ->whereDate('fecha', '=', $request->get('fecha'))
            ->whereTime('hora', '=', $request->get('hora'))
            ->first();

        if ($citas) {
            return response()->json(
                ['citaexiste' => 'Ya existe una cita programada a esa hora.'],
                500
            );
        }
        $cita = Cita::findOrFail($id);
        $cita->paciente_id = $request->get('paciente_id');
        $cita->medico_id = $request->get('medico_id');
        $cita->fecha = $request->get('fecha');
        $cita->hora = $request->get('hora');
        $cita->motivo_cita = $request->get('motivo_cita');
        $cita->save();

        return  $cita;
    }
    //Envio de credenciales al crear un usuario
    public function SendCredencialesEmail()
    {
        if (Auth::user()->cannot('user_authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $variable = request(['email', 'name', 'username', 'user_type', 'cedula', 'password']);

        try {
            Mail::to($variable['email'])->send(new CredencialesEmail($variable));
            return response()->json(
                ['message' => 'correo enviado'],
                200
            );
        } catch (\Throwable $th) {

            return response()->json(
                ['error' => 'Error al enviar el correo.'],
                500
            );
        }
    }
    public function BuscarEvolucionesxFecha($id_paciente, $fecha)
    {

        //Politica para restringir autorización
        if (Auth::user()->cannot('authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $evoluciones = DB::table('pacientes')
            ->join('historias_clinicas', 'historias_clinicas.paciente_id', '=', 'pacientes.paciente_id')
            ->join('evoluciones', 'evoluciones.historia_clinica_id', '=', 'historias_clinicas.historia_clinica_id')
            ->select(
                'pacientes.paciente_id',
                'historias_clinicas.historia_clinica_id',
                'evoluciones.*'
            )
            ->where('pacientes.paciente_id', '=', $id_paciente)
            ->whereDate('evoluciones.fecha', '=', $fecha)
            ->orderBy('evoluciones.fecha', 'asc')
            ->paginate(5);
        return json_encode($evoluciones);
    }
}
