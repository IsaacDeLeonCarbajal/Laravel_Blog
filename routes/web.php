<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\UsuarioController;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', fn () => redirect()->route('home'));

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');

    Route::get('/categoria/{categoria}', 'index')->name('home.categorias');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/registrar', 'showForm')->name('register.showForm');

    Route::post('/registrar', 'store')->name('register.store');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showForm')->name('login.showForm');

    Route::post('/login', 'login')->name('login.login');

    Route::get('/logout', 'logout')->name('login.logout');
});

Route::controller(UsuarioController::class)->group(function () {
    Route::get('/usuarios', 'index')->name('usuarios.index');

    Route::get('/usuarios/{usuario}', 'show')->name('usuarios.show');
});

Route::controller(PublicacionController::class)->group(function () {
    Route::get('/publicaciones', 'create')->name('publicaciones.create');

    Route::post('/publicaciones', 'store')->name('publicaciones.store');

    Route::get('/publicaciones/{publicacion}', 'show')->name('publicaciones.show');

    Route::get('/publicaciones/{publicacion}/edit', 'edit')->name('publicaciones.edit');

    Route::put('/publicaciones/{publicacion}', 'update')->name('publicaciones.update');

    Route::delete('/publicaciones/{publicacion}', 'destroy')->name('publicaciones.destroy');
});

Route::controller(ComentarioController::class)->group(function () {
    Route::post('/comentarios', 'store')->name('comentarios.store');

    Route::get('/comentarios/{comentario}/edit', 'edit')->name('comentarios.edit');

    Route::put('/comentarios/{comentario}', 'update')->name('comentarios.update');

    Route::delete('/comentarios/{comentario}', 'destroy')->name('comentarios.destroy');
});

Route::get('/test', function () {
    return Auth::user()->publicaciones->pluck('id');
});
