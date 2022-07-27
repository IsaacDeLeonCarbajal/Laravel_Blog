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
                        <input class="form-control" type="text" name="nombre" placeholder="Nombre(s)">
                    </div>

                    <div class="col">
                        <label class="form-text">Apellido Paterno</label>
                        <input class="form-control" type="text" name="apellido_paterno" placeholder="Apellido Paterno">
                    </div>

                    <div class="col">
                        <label class="form-text">Apellido Materno</label>
                        <input class="form-control" type="text" name="apellido_materno" placeholder="Apellido Paterno">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-5">
                        <label class="form-text">Correo Electrónico</label>
                        <input class="form-control" type="email" name="email" placeholder="Correo Electrónico">
                    </div>

                    <div class="col">
                        <label class="form-text">Contraseña</label>
                        <input class="form-control" type="text" name="password" placeholder="Contraseña">
                    </div>

                    <div class="col">
                        <label class="form-text">Confirmar Contraseña</label>
                        <input class="form-control" type="text" name="password_confirmation" placeholder="Confirmar Contraseña">
                    </div>
                </div>

                <label class="mb-3"><input class="me-2" type="checkbox" name="recordar">Recordar</label>

            </div>

            <div class="card-footer">
                <div class="d-flex flex-row">
                    <button class="btn btn-primary ms-auto">Registrar</button>
                </div>
            </div>
        </div>
    </form>

    {{-- <main class="signup-form">
                <div class="cotainer">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="card">
                                <h3 class="card-header text-center">Register User</h3>
                                <div class="card-body">
                                    <form action="{{ route('register.custom') }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                                                required autofocus>
                                            @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="text" placeholder="Email" id="email_address" class="form-control"
                                                name="email" required autofocus>
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="password" placeholder="Password" id="password" class="form-control"
                                                name="password" required>
                                            @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="remember"> Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="d-grid mx-auto">
                                            <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main> --}}
@endsection
