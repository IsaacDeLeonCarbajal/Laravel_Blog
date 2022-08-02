@extends('layouts.master')

@section('title', 'Registrarse')

@section('content-center')
    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header">
                <label class="fs-3 fw-bold">Registrar Usuario</label>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-text">Nombre(s)</label>
                        <input class="form-control" type="text" name="nombre" placeholder="Nombre(s)" value="{{ old('nombre') }}">

                        @if ($errors->has('nombre'))
                            @component('layouts.alert')
                                @slot('message', $errors->first('nombre'))
                            @endcomponent
                        @endif
                    </div>

                    <div class="col">
                        <label class="form-text">Apellido Paterno</label>
                        <input class="form-control" type="text" name="apellido_paterno" placeholder="Apellido Paterno" value="{{ old('apellido_paterno') }}">

                        @if ($errors->has('apellido_paterno'))
                            @component('layouts.alert')
                                @slot('message', $errors->first('apellido_paterno'))
                            @endcomponent
                        @endif
                    </div>

                    <div class="col">
                        <label class="form-text">Apellido Materno</label>
                        <input class="form-control" type="text" name="apellido_materno" placeholder="Apellido Paterno" value="{{ old('apellido_materno') }}">

                        @if ($errors->has('apellido_materno'))
                            @component('layouts.alert')
                                @slot('message', $errors->first('apellido_materno'))
                            @endcomponent
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-5">
                        <label class="form-text">Correo Electrónico</label>
                        <input class="form-control" type="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            @component('layouts.alert')
                                @slot('message', $errors->first('email'))
                            @endcomponent
                        @endif
                    </div>

                    <div class="col">
                        <label class="form-text">Contraseña</label>
                        <div class="input-group mb-3">
                            <input class="form-control" type="password" name="password" placeholder="Contraseña" style="border-right: none;">

                            <button class="btn btn-outline-secondary btn-contrasena" type="button" onclick="visibilidadContrasena(this, jQuery('input[name=password]'));"></button>
                        </div>

                        @if ($errors->has('password'))
                            @component('layouts.alert')
                                @slot('message', $errors->first('password'))
                            @endcomponent
                        @endif
                    </div>

                    <div class="col">
                        <label class="form-text">Confirmar Contraseña</label>
                        <div class="input-group mb-3">
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Contraseña" style="border-right: none;">

                            <button class="btn btn-outline-secondary btn-contrasena" type="button" onclick="visibilidadContrasena(this, jQuery('input[name=password_confirmation]'));"></button>
                        </div>

                        @if ($errors->has('password_confirmation'))
                            @component('layouts.alert')
                                @slot('message', $errors->first('password_confirmation'))
                            @endcomponent
                        @endif
                    </div>
                </div>

                <label class="mb-3"><input class="me-2" type="checkbox" name="remember">Recordar</label>

            </div>

            <div class="card-footer">
                <div class="d-flex flex-row">
                    <button class="btn btn-primary ms-auto">Registrar</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('content-right')
    <a class="btn btn-warning" href="{{route('login')}}">¿Ya tienes una cuenta?</a>
@endsection
