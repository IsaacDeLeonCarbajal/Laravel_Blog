<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuario = Usuario::find(HomeController::getUsuarioId());

        return view('usuarios.index', compact('usuario'));
    }

    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }
}
