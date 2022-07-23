@extends('layouts.master')

@section('title')
    Usuario {{ $usuario->nombre }}
@endsection

@section('content-center')
    <h1 class="col-12 text-center">{{ $usuario->nombre }} {{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno }}</h1>

    <label class="text-muted mt-4">Correo electrónico: {{ $usuario->correo }}</label>

    <div class="col-12 mt-4">
        <h3 class="col-12">Publicaciones</h3>

        <div class="row row-cols-1 row-cols-md-2 col-12">
            @foreach ($usuario->publicaciones as $pub)
                @component('layouts.publicacion-card', ['categs' => $pub->categorias])
                    @slot('title', $pub->titulo)

                    @slot('subtitle', $pub->usuario->nombre . ' ' . $pub->usuario->apellido_paterno . ' ' . Str::substr($pub->updated_at, 0, 10) . ' ')

                    @slot('content', Str::substr($pub->contenido, 0, 150) . '...')

                    @slot('route', route('publicaciones.show', $pub))
                @endcomponent
            @endforeach
        </div>

        <h3 class="col-12 my-4">Comentarios</h3>

        @foreach ($usuario->comentarios as $com)
            @component('layouts.comentario-list')
                @slot('title', $com->publicacion->titulo)

                @slot('subtitle', $com->updated_at)

                @slot('route', route('publicaciones.show', $com->publicacion))

                @slot('content', $com->contenido)
            @endcomponent
        @endforeach
    </div>
@endsection

@section('content-right')
    <a class="btn btn-primary" href="{{ route('publicaciones.create') }}">Nueva publicación</a>
@endsection
