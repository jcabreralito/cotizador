<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait PermisosTrait
{
    public static function idUsuario()
    {
        $Login = session('usuario');

        $datos_usuario = DB::select('exec GetUsuario @Login=' . $Login);
        $id_usuario = $datos_usuario[0]->Id_Usuario;

        return $id_usuario;
    }

    public static function datosUsuario()
    {
        $Login = session('usuario');

        $datos_usuario = DB::select('exec GetUsuario @Login=' . $Login);

        return $datos_usuario;
    }

    public static function permiso()
    {
        $Login = session('usuario');

        $datos_usuario = DB::select('exec GetUsuario @Login=' . $Login);

        if ($datos_usuario == null) {
            return view('inicio');
        }

        $id_usuario = $datos_usuario[0]->Id_Usuario;

        $permisos = DB::table('v_catUsuarios')->select('Permiso')->where('Id_Usuario', $id_usuario)->first();

        $permiso = $permisos->Permiso;

        if ($permiso == 1) {
            session(['privilegios' => 1]);
        } else if ($permiso == 2) {
            session(['privilegios' => 2]);
        } else if ($permiso == 3) {
            session(['privilegios' => 3]);
        } else if ($permiso == 4) {
            session(['privilegios' => 4]);
        }

        return session('privilegios');
    }

    public static function permiso_tipo()
    {
        $Login = session('usuario');

        $datos_usuario = DB::select('exec GetUsuario @Login=' . $Login);

        if ($datos_usuario == null) {
            return view('inicio');
        }

        $id_usuario = $datos_usuario[0]->Id_Usuario;

        $permisos = DB::table('v_catUsuarios')->select('Permiso')->where('Id_Usuario', $id_usuario)->first();

        return $permisos;
    }

    public static function loginUsuario()
    {
        $Login = session('usuario');

        return $Login;
    }

}
