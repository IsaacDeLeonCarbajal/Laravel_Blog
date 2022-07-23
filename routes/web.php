<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\UsuarioController;
use App\Models\Categoria;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'index')->name('home');
});

Route::controller(UsuarioController::class)->group(function() {
    Route::get('/usuarios/{usuario}', 'show')->name('usuarios.show');
});

Route::controller(PublicacionController::class)->group(function() {
    Route::get('/publicaciones/{publicacion}', 'show')->name('publicaciones.show');
});

Route::controller(ComentarioController::class)->group(function() {
    Route::post('/comentarios', 'store')->name('comentarios.store');
});
