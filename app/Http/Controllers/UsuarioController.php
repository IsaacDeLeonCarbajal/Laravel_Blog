<?php

namespace App\Http\Controllers;

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
}
