@extends('layouts.master')

@section('title', 'Editar Permisos')

@section('content-center')
    <h1>Editar Permisos</h1>

    <h4 class="mt-4">{{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno }} {{ $usuario->nombre }}</h4>

    <hr>

    <h4>Permisos</h4>

    <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
        @csrf

        @method('put')

        <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">

        <div class="col-12 row row-cols-2 row-cols-md-5 mt-3">
            @foreach ($roles as $r)
                <label class="col-12 mb-2">
                    <input class="me-2" type="checkbox" {{ $usuario->roles->contains($r) ? 'checked' : '' }} {{ $r->rol == 'usuario' ? 'checked disabled' : 'name=roles[] value=' . $r->id }}>
                    {{ ucwords($r->rol) }}
                </label>
            @endforeach
        </div>

        @error('usuario_id')
            @component('layouts.alert')
                @slot('message', $message)
            @endcomponent
        @enderror

        @error('roles')
            @component('layouts.alert')
                @slot('message', $message)
            @endcomponent
        @enderror

        <div class="d-flex flex-row">
            <button class="btn btn-primary ms-auto mt-3" type="submit">Actualizar</button>
        </div>
    </form>
@endsection
