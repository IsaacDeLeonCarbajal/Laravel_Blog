@extends('layouts.master')

@section('title', 'Editar comentario')

@section('content-center')
<form action="{{ route('comentarios.update', $comentario) }}" method="POST">
    @csrf

    @method('put')

    <label class="form-control-plaintext form-control-lg">{{ $comentario->publicacion->titulo }}</label>

    <textarea class="form-control mt-5" name="contenido" rows="10" placeholder="Contenido"> {{ old('contenido', $comentario->contenido) }}</textarea>

    @error('contenido')
        @component('layouts.alert')
            @slot('message', $message)
        @endcomponent
    @enderror

    <a class="btn btn-secondary mt-4" href="{{route ('usuarios.index')}}">Cancelar</a>

    <button class="btn btn-primary mt-4 ms-3" type="submit">Actualizar</button>
</form>
@endsection
