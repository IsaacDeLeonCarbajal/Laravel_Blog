<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\CategoriaPublicacion;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

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
            'categorias.*' => 'integer | exists:categorias,id',
            'imagen' => [File::types(['png', 'jpg', 'jpeg'])->min(10)->max(12 * 1024), 'dimensions:min_width=600,min_height=400,max_width=1200,max_height=800']
        ]);

        $publicacion = new Publicacion();
        $publicacion->usuario_id = Auth::user()->id;
        $publicacion->titulo = $request->titulo;
        $publicacion->contenido = $request->contenido;

        $publicacion->save();

        foreach ($request->categorias as $cat) {
            $catPub = new CategoriaPublicacion();
            $catPub->publicacion_id = $publicacion->id;
            $catPub->categoria_id = $cat;

            $catPub->save();
        }

        $request->file('imagen')->storeAs('publicaciones', $publicacion->id . '.png', 'public');

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

        if (!Auth::user()->publicaciones->contains($publicacion)) {
            $mensaje = "No tiene permiso para editar esa publicación";
            
            return view('error', compact('mensaje'));
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
        if (!Auth::user()->publicaciones->contains($publicacion)) {
            $mensaje = "No tiene permiso para eliminar esa publicación";

            return view('error', compact('mensaje'));
        }

        $publicacion->delete();

        Storage::delete(asset('storage/publicaciones/' . $publicacion->id . '.png'));

        return redirect()->route('usuarios.index');
    }
}
