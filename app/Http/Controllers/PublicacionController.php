<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\CategoriaPublicacion;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PublicacionController extends Controller
{

    public function create()
    {
        $categorias = Categoria::all();

        return view('publicaciones.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required | string | max:200',
            'contenido' => 'required | string',
            'categorias' => 'required | array',
            'categorias.*' =>  'integer | exists:categorias,id'
        ]);

        $publicacion = new Publicacion();
        $publicacion->usuario_id = HomeController::getUsuarioId();
        $publicacion->titulo = $request->titulo;
        $publicacion->contenido = $request->contenido;

        $publicacion->save();

        foreach($request->categorias as $cat) {
            $catPub = new CategoriaPublicacion();
            $catPub->publicacion_id = $publicacion->id;
            $catPub->categoria_id = $cat;

            $catPub->save();
        }

        return redirect()->route('publicaciones.show', $publicacion);
    }

    public function show(Publicacion $publicacion)
    {
        return view('publicaciones.show', compact('publicacion'));
    }
}
