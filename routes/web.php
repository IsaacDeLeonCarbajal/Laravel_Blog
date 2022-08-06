<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\UsuarioController;
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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);

    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');

    Route::get('/categoria/{categoria}', 'index')->name('home.categorias');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/registrar', 'showForm')->name('register.showForm');

    Route::post('/registrar', 'store')->name('register.store');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showForm')->name('login');

    Route::post('/login', 'login')->name('login.login');

    Route::get('/logout', 'logout')->name('login.logout');
});

Route::controller(UsuarioController::class)->group(function () {
    Route::get('/usuarios', 'index')->name('usuarios.index')->middleware('verified');
    
    Route::get('/usuarios/admin', 'admin')->name('usuarios.admin');
    
    Route::get('/usuarios/{usuario}', 'show')->name('usuarios.show');

    Route::get('/usuarios/{usuario}/edit', 'edit')->name('usuarios.edit');

    Route::put('/usuarios/{usuario}', 'update')->name('usuarios.update');
});

Route::controller(PublicacionController::class)->group(function () {
    Route::get('/publicaciones', 'create')->name('publicaciones.create');

    Route::post('/publicaciones', 'store')->name('publicaciones.store')->middleware('verified');

    Route::get('/publicaciones/{publicacion}', 'show')->name('publicaciones.show');

    Route::get('/publicaciones/{publicacion}/edit', 'edit')->name('publicaciones.edit');

    Route::put('/publicaciones/{publicacion}', 'update')->name('publicaciones.update')->middleware('verified');

    Route::delete('/publicaciones/{publicacion}', 'destroy')->name('publicaciones.destroy');
});

Route::controller(ComentarioController::class)->group(function () {
    Route::post('/comentarios', 'store')->name('comentarios.store')->middleware('verified');

    Route::get('/comentarios/{comentario}/edit', 'edit')->name('comentarios.edit');

    Route::put('/comentarios/{comentario}', 'update')->name('comentarios.update');

    Route::delete('/comentarios/{comentario}', 'destroy')->name('comentarios.destroy');
});
