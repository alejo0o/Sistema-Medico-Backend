<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    //Creacion de Usuerios con permisos
    public function crearUsuarios(Request $request)
    {
        //Politica para restringir autorización
        if (Auth::user()->cannot('user_authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->user_type = $request->user_type;
        $user->cedula = $request->cedula;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(
            [
                'message' => 'Usuario Creado'
            ],
            201
        );
    }
    //Obtiene el usuario por id
    public function getUsuarioxID($id)
    {
        if (Auth::user()->cannot('user_authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $usuario = DB::table('users')
            ->select('id', 'name', 'username', 'email', 'cedula', 'user_type')
            ->where('id', '=', $id)
            ->first();

        return json_encode($usuario);
    }
    //Busca los usuarios por nombre o cedula
    public function getUsuariosxCedulaoNombre($busqueda)
    {
        if (Auth::user()->cannot('user_authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $usuario = DB::table('users')
            ->select('id', 'name', 'username', 'email', 'cedula')
            ->where('cedula', 'ilike', "$busqueda%")
            ->orWhere('username', 'ilike', "$busqueda%")
            ->paginate(1);

        return json_encode($usuario);
    }
    //Edita los datos del usuario
    public function editarUsuario(Request $request, $id)
    {
        if (Auth::user()->cannot('user_authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->cedula = $request->cedula;
        $usuario->user_type = $request->user_type;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        return response()->json(
            $usuario,
            200
        );
    }
    //Elimina el usuario por id
    public function eliminarUsuario($id)
    {
        if (Auth::user()->cannot('user_authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }
        User::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Success'
        ], 204);
    }
    //Verfica la existencia de cedula
    public function cedulaExiste($cedula)
    {
        if (Auth::user()->cannot('user_authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $usuario = DB::table('users')
            ->select('*')
            ->where('cedula', '=', $cedula)
            ->first();

        if ($usuario)
            return true;

        return false;
    }
    //Verfica la existencia de cedula
    public function usernameExiste($username)
    {
        if (Auth::user()->cannot('user_authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $usuario = DB::table('users')
            ->select('*')
            ->where('username', '=', $username)
            ->first();

        if ($usuario)
            return true;

        return false;
    }
    //Verfica la existencia de cedula
    public function emailExiste($email)
    {
        if (Auth::user()->cannot('user_authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $usuario = DB::table('users')
            ->select('*')
            ->where('email', '=', $email)
            ->first();

        if ($usuario)
            return true;

        return false;
    }
    //Verfica la existencia de cedula
    public function cedulaExisteEdit($cedula, $id)
    {
        if (Auth::user()->cannot('user_authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $usuario = DB::table('users')
            ->select('*')
            ->where('id', '!=', $id)
            ->where('cedula', '=', $cedula)
            ->first();

        if ($usuario)
            return true;

        return false;
    }
    //Verfica la existencia de cedula
    public function usernameExisteEdit($username, $id)
    {
        if (Auth::user()->cannot('user_authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $usuario = DB::table('users')
            ->select('*')
            ->where('id', '!=', $id)
            ->where('username', '=', $username)
            ->first();

        if ($usuario)
            return true;

        return false;
    }
    //Verfica la existencia de cedula
    public function emailExisteEdit($email, $id)
    {
        if (Auth::user()->cannot('user_authorize', User::class)) {
            abort(403, 'Usuario no autorizado');
        }

        $usuario = DB::table('users')
            ->select('*')
            ->where('id', '!=', $id)
            ->where('email', '=', $email)
            ->first();

        if ($usuario)
            return true;

        return false;
    }
}
