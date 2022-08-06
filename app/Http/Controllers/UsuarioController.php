<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\RolUsuario;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function index()
    {
        if (!Auth::check()) { //Si no se ha iniciado sesión
            return redirect()->route('home'); //Redireccionar a la página principal
        }

        $usuario = Auth::user();

        return view('usuarios.index', compact('usuario'));
    }

    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    public function admin()
    {
        if (!Auth::check() || !Auth::user()->roles->contains('rol', 'admin')) {
            return view('error', ['mensaje' => 'Requiere permisos de administrador para realizar esta acción']);
        }

        $usuarios = Usuario::orderBy('apellido_paterno', 'asc')->paginate();

        return view('usuarios.admin', compact('usuarios'));
    }

    public function edit(Usuario $usuario)
    {
        if (!Auth::check() || !Auth::user()->roles->contains('rol', 'admin')) {
            return view('error', ['mensaje' => 'Requiere permisos de administrador para realizar esta acción']);
        }

        $roles = Rol::orderBy('id', 'desc')->get();

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Usuario $usuario, Request $request)
    {
        $request->request->add(['admin_id' => strval(Auth::user()->id)]);

        $request->validate([
            'usuario_id' => 'required | numeric | different:admin_id',
            'roles' => 'array'
        ]);

        //Eliminar todos los permisos anteriores
        foreach ($usuario->roles as $rol) {
            $rol->pivot->delete();
        }

        //Agregar todos los nuevos roles
        if ($request->roles) {
            foreach ($request->roles as $rolId) {
                $rolUsuario = new RolUsuario();

                $rolUsuario->usuario_id = $request->usuario_id;
                $rolUsuario->rol_id = $rolId;

                $rolUsuario->save();
            }
        }

        return redirect()->route('usuarios.edit', $usuario);
    }
}
