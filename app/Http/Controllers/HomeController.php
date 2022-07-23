<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\CategoriaPublicacion;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Mockery\Undefined;

class HomeController extends Controller
{
    public function index(Request $request) {
        if ($request->categoria) {
            $publicaciones = Publicacion::whereIn('id', CategoriaPublicacion::where('categoria_id', $request->categoria)->pluck('publicacion_id'))->orderBy('updated_at', 'desc')->simplePaginate(10);

            $publicaciones->appends(['categoria' => $request->categoria]); //Agregar el parametro GET a la paginación

            $categoria = Categoria::find($request->categoria);
        } else {
            $publicaciones = Publicacion::orderBy('updated_at', 'desc')->simplePaginate(10);

            $categoria = null;
        }

        $categorias = Categoria::all();
    
        return view('home', compact('publicaciones', 'categorias', 'categoria'));
    }

    public function getUsuarioId() {
        return 1;
    }
}
