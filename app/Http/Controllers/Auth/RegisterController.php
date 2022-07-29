<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required | string | max:30',
            'apellido_paterno' => 'required | string | max:30',
            'apellido_materno' => 'required | string | max:30',
            'email' => 'required | string | email | max:255 | unique:usuarios',
            'password' => 'required | string | min:8 | confirmed',
            'password_confirmation' => 'required | string',
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::loginUsingId($usuario->id, $request->filled('remember'));

        return redirect()->route('usuarios.index');
    }
}
