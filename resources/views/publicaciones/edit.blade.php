@extends('layouts.master')

@section('title', 'Editar publicación')

@section('content-center')
    <form action="{{ route('publicaciones.update', $publicacion) }}" method="POST">
        @csrf

        @method('put')

        <input class="form-control form-control-lg" type="text" name="titulo" value="{{ old('titulo', $publicacion->titulo) }}" placeholder="Titulo de la Publicación">

        @error('titulo')
            @component('layouts.alert')
                @slot('message', $message)
            @endcomponent
        @enderror

        <textarea class="form-control mt-5" name="contenido" rows="10" placeholder="Contenido"> {{ old('contenido', $publicacion->contenido) }}</textarea>

        @error('contenido')
            @component('layouts.alert')
                @slot('message', $message)
            @endcomponent
        @enderror

        <h4 class="mt-4">Categorias</h4>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 col-12">
            @foreach ($categorias as $cat)
                <label class="col-12 mb-2">
                    <input class="me-2" type="checkbox" name="categorias[]" value="{{ $cat->id }}" {{ old('categorias') != null ? (in_array($cat->id, old('categorias')) ? 'checked' : '') : ($publicacion->categorias->contains('id', $cat->id) ? 'checked' : '') }}>
                    {{ $cat->categoria }}
                </label>
            @endforeach
        </div>

        @error('categorias')
            @component('layouts.alert')
                @slot('message', $message)
            @endcomponent
        @enderror

        @error('categorias.*')
            @component('layouts.alert')
                @slot('message', $message)
            @endcomponent
        @enderror

        <a class="btn btn-secondary mt-4" href="{{route ('usuarios.index')}}">Cancelar</a>

        <button class="btn btn-primary mt-4 ms-3" type="submit">Actualizar</button>
    </form>
@endsection
