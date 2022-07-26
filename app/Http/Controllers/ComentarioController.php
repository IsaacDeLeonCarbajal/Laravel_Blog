<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Publicacion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ComentarioController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required | string',
            'publicacion_id' => 'required | exists:publicaciones,id',
            'comentario_id' => 'nullable | exists:comentarios,id'
        ]);

        $comentario = new Comentario();
        $comentario->usuario_id = HomeController::getUsuarioId();
        $comentario->publicacion_id = $request->publicacion_id;
        $comentario->contenido = $request->contenido;

        if ($request->comentario_id) {
            $comentario->comentario_id = $request->comentario_id;
        } else {
            $comentario->comentario_id = null;
        }

        $comentario->save();

        return redirect()->route('publicaciones.show', ['publicacion' => $request->publicacion_id]);
    }

    public function edit(Comentario $comentario) {
        return view('comentarios.edit', compact('comentario'));
    }

    public function update(Comentario $comentario, Request $request) {
        $request->validate([
            'contenido' => 'required | string',
        ]);

        if (!Usuario::find(HomeController::getUsuarioId())->comentarios->contains($comentario)) {
            return "ERROR: No tiene permiso de editar ese comentario";
        }

        $comentario->contenido = $request->contenido;

        $comentario->save();

        return redirect()->route('usuarios.index');
    }

    public function destroy(Comentario $comentario) {
        if (!Usuario::find(HomeController::getUsuarioId())->comentarios->contains($comentario)) {
            return "ERROR: No tiene permiso para eliminar ese comentario";
        }

        $comentario->delete();

        return redirect()->route('usuarios.index');
    }
}
