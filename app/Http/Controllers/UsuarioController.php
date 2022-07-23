<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function show()
    {
        $usuario = Usuario::find(HomeController::getUsuarioId());

        return view('usuarios.show', compact('usuario'));
    }
}
