<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function show(Usuario $usuario) {
        return view('usuarios.show', compact('usuario'));
    }
}
