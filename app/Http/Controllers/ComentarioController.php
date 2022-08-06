<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login.showForm');
        }

        $request->validate([
            'contenido' => 'required | string',
            'publicacion_id' => 'required | exists:publicaciones,id',
            'comentario_id' => 'nullable | exists:comentarios,id'
        ]);

        $comentario = new Comentario();
        $comentario->usuario_id = Auth::user()->id;
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

    public function edit(Comentario $comentario)
    {
        return view('comentarios.edit', compact('comentario'));
    }

    public function update(Comentario $comentario, Request $request)
    {
        $request->validate([
            'contenido' => 'required | string',
        ]);

        if (!Auth::user()->comentarios->contains($comentario)) {
            $mensaje = "No tiene permiso para editar ese comentario";

            return view('error', compact('mensaje'));
        }

        $comentario->contenido = $request->contenido;

        $comentario->save();

        return redirect()->route('usuarios.index');
    }

    public function destroy(Comentario $comentario)
    {
        if (!Auth::check()) { //Si no se ha iniciado sesión
            return view('error', ['mensaje' => 'No tiene permiso de eliminar comentarios']);
        } else if (!Auth::user()->roles->contains('rol', 'admin')) { //Si el usuario no es administrador
            if (!Auth::user()->comentarios->contains($comentario)) { //Si la comentario no pertenece al usuario
                return view('error', ['mensaje' => 'No tiene permiso para eliminar ese comentario']);
            }
        }

        $comentario->delete();

        return redirect()->back();
    }
}
