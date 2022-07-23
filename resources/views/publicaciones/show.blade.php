@extends('layouts.master')

@section('title')
    {{ $publicacion->titulo }}
@endsection

@section('content-center')
    <a href="{{ url()->previous() }}">Regresar</a>
    <h1 class="col-12 text-center">{{ $publicacion->titulo }}</h1>

    <div class="col-12 mt-5 d-flex justify-content-between text-muted">
        <label>Autor: {{ $publicacion->usuario->nombre }} {{ $publicacion->usuario->apellido_paterno }} {{ $publicacion->usuario->apellido_materno }}</label>
        <label>Fecha de creación: {{ $publicacion->created_at }}</label>
        <label>Última vez editado: {{ $publicacion->updated_at }}</label>
    </div>

    <div class="col-12 mt-3 text-muted">
        @foreach ($publicacion->categorias as $cat)
            <a class="btn btn-outline-secondary me-3 py-1" href="{{ route('home') }}/?categoria={{ $cat->id }}">{{ $cat->categoria }}</a>
        @endforeach
    </div>

    <div class="col-12 mt-4 fs-5">
        {{ $publicacion->contenido }}
    </div>

    <div class="col-12 mt-5">
        <h4>Comentarios</h4>

        <hr>

        @foreach ($publicacion->comentarios as $com)
            @component('layouts.comentario-list')
                @slot('title')
                    {{ $com->usuario->nombre }}
                @endslot

                @slot('subtitle')
                    {{ $com->updated_at }}
                @endslot

                @slot('content')
                    {{ $com->contenido }}
                @endslot
            @endcomponent
        @endforeach

        <form class="my-4" action="{{ route('comentarios.store') }}" method="POST">
            @csrf

            <h5 class="mb-3">Deja un comentario</h5>

            <input type="hidden" name="publicacion_id" value="{{ $publicacion->id }}">

            <textarea class="form-control mb-3" name="contenido" rows="3"></textarea>

            <button class="btn btn-primary" type="submit">Enviar</button>
        </form>
    </div>
@endsection

@section('content-right')
    <h4>Otras publicaciones del autor</h4>

    <div class="col-12">
        @foreach ($publicacion->usuario->publicaciones as $pub)
            {{-- No mostrar la publicación que ya se está mostrando --}}

            @if ($publicacion->id != $pub->id)
                @component('layouts.publicacion-list', ['categs' => $pub->categorias])
                    @slot('title')
                        {{ $pub->titulo }}
                    @endslot

                    @slot('content')
                        {{ $pub->usuario->nombre }} {{ $pub->usuario->apellido_paterno }}: {{ Str::substr($pub->updated_at, 0, 10) }}
                    @endslot

                    @slot('route')
                        {{ route('publicaciones.show', $pub) }}
                    @endslot
                @endcomponent
            @endif
        @endforeach
    </div>
@endsection

@section('script')
@endsection
