<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\CategoriaPublicacion;
use App\Models\Publicacion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use function Symfony\Component\String\u;

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

        foreach ($request->categorias as $cat) {
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

    public function edit(Publicacion $publicacion)
    {
        $categorias = Categoria::all();

        return view('publicaciones.edit', compact('publicacion', 'categorias'));
    }

    public function update(Publicacion $publicacion, Request $request)
    {
        $request->validate([
            'titulo' => 'required | string | max:200',
            'contenido' => 'required | string',
            'categorias' => 'required | array',
            'categorias.*' =>  'integer | exists:categorias,id'
        ]);

        if (!Usuario::find(HomeController::getUsuarioId())->publicaciones->contains($publicacion)) {
            return "ERROR: No tiene permiso de editar esa publicación";
        }

        $publicacion->titulo = $request->titulo;
        $publicacion->contenido = $request->contenido;

        $publicacion->save();

        foreach ($publicacion->categorias as $cat) { //Eliminar las relaciones con categorías anteriores
            $cat->pivot->delete();
        }

        foreach ($request->categorias as $idCat) { //Agregar las nuevas relaciones con categorías
            $catPub = new CategoriaPublicacion();
            $catPub->publicacion_id = $publicacion->id;
            $catPub->categoria_id = $idCat;

            $catPub->save();
        }

        return redirect()->route('publicaciones.show', $publicacion);
    }

    public function destroy(Publicacion $publicacion)
    {
        if (!Usuario::find(HomeController::getUsuarioId())->publicaciones->contains($publicacion)) {
            return "ERROR: No tiene permiso para eliminar esa publicación";
        }

        $publicacion->delete();

        return redirect()->route('usuarios.index');
    }
}
