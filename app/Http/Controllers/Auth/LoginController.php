<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm()
    {

      return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required | string | email',
            'password' => 'required | string',
        ]);



        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }

        return redirect()->route('login.login')->with('error', 'El correo o la contraseña son inválidos');
    }

    public function logout() {
      Auth::logout();

      return redirect()->route('login.showForm');
    }
}
