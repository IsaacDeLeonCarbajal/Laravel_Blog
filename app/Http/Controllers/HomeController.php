<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\CategoriaPublicacion;
use App\Models\Publicacion;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Categoria $categoria, Request $request)
    {
        if ($request->busqueda) { //Si existe una búsqueda
            $publicaciones = Publicacion::where('titulo', 'LIKE', '%'.$request->busqueda.'%')->orderBy('updated_at', 'desc')->simplePaginate(10);

            $publicaciones->appends(['busqueda' => $request->busqueda]);

            $categoria = null;
        } else if ($categoria->exists) { //Si se filtró por categoría
            $publicaciones = Publicacion::whereIn('id', CategoriaPublicacion::where('categoria_id', $categoria->id)->pluck('publicacion_id'))->orderBy('updated_at', 'desc')->simplePaginate(10);
        } else { //Si no se desea ningún filtro
            $publicaciones = Publicacion::orderBy('updated_at', 'desc')->simplePaginate(10);

            $categoria = null;
        }

        $categorias = Categoria::all();

        return view('home', compact('publicaciones', 'categorias', 'categoria'));
    }

    public static function getUsuarioId()
    {
        return 1;
    }
}
