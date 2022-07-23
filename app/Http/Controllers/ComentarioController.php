<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ComentarioController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required | string',
            'publicacion_id' => ['required', 'exists:publicaciones,id']
        ]);

        $comentario = new Comentario();
        $comentario->usuario_id = HomeController::getUsuarioId();
        $comentario->publicacion_id = $request->publicacion_id;
        $comentario->contenido = $request->contenido;

        $comentario->save();

        return redirect()->route('publicaciones.show', ['publicacion' => $request->publicacion_id]);
    }
}
