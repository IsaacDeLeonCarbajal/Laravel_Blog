<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    public function show(Publicacion $publicacion) {
        return view('publicaciones.show', compact('publicacion'));
    }
}
