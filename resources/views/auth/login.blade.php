@extends('layouts.master')

@section('title', 'Iniciar Sesión')

@section('content-center')
    <div class="card col-10 col-md-6 offset-1 offset-md-3">
        <h3 class="card-header text-center">Login</h3>
        <div class="card-body">
            <form method="POST" action="{{ route('login.login') }}">
                @csrf
                <div class="form-group mb-3">
                    <input class="form-control" type="email" name="email" placeholder="Correo Electrónico">

                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <input class="form-control" type="password" name="password" placeholder="Contraseña">

                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <label class="mb-3"><input class="me-2" type="checkbox" name="recordar">Recordar</label>

                <button class="col-12 btn btn-dark" type="submit">Iniciar Sesión</button>
            </form>

            @if (session()->has('error'))
                @component('layouts.alert')
                    @slot('message', session()->get('error'))
                @endcomponent
            @endif
        </div>
    </div>
@endsection
