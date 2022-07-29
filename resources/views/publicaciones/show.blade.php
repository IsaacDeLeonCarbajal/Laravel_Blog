@extends('layouts.master')

@section('title')
    {{ $publicacion->titulo }}
@endsection

@section('content-center')
    <a href="{{ url()->previous() }}">Regresar</a>

    <img class="col-12" src="{{ asset('storage/publicaciones/' . $publicacion->id . '.png') }}" onerror="this.style.display='none'">

    <h1 class="col-12 mt-3 text-center">{{ $publicacion->titulo }}</h1>

    <div class="col-12 mt-4 d-flex justify-content-between text-muted">
        <label>Autor: {{ $publicacion->usuario->nombre }} {{ $publicacion->usuario->apellido_paterno }} {{ $publicacion->usuario->apellido_materno }}</label>
        <label>Fecha de creación: {{ $publicacion->created_at }}</label>
        <label>Última vez editado: {{ $publicacion->updated_at }}</label>
    </div>

    <div class="col-12 mt-3 text-muted">
        @foreach ($publicacion->categorias as $cat)
            <a class="btn btn-outline-secondary me-3 py-1" href="{{ route('home.categorias', $cat) }}">{{ $cat->categoria }}</a>
        @endforeach
    </div>

    <div class="col-12 mt-4 fs-5" style="white-space: pre-wrap;">{{ $publicacion->contenido }}</div>

    <div class="col-12 mt-5">
        <h4>Comentarios</h4>

        <hr>

        @include('layouts.comentario-list', ['comentario' => $publicacion])

        <form class="my-4" action="{{ route('comentarios.store') }}" method="POST">
            @csrf

            <h5 class="mb-3">Deja un comentario</h5>

            <button class="btn btn-outline-secondary py-1 mb-3" id="btn-cancelar-respuesta" type="button" onclick="responder();" style="display: none;"></button>

            <input type="hidden" name="publicacion_id" value="{{ $publicacion->id }}">

            @error('publicacion_id')
                @component('layouts.alert')
                    @slot('message', $message)
                @endcomponent
            @enderror

            <input type="hidden" name="comentario_id" value="">

            @error('comentario_id')
                @component('layouts.alert')
                    @slot('message', $message)
                @endcomponent
            @enderror

            <textarea class="form-control mb-3" name="contenido" rows="3">{{ old('contenido') }}</textarea>

            @error('contenido')
                @component('layouts.alert')
                    @slot('message', $message)
                @endcomponent
            @enderror

            <button class="btn btn-primary" type="submit">Enviar</button>
        </form>
    </div>
@endsection

@section('content-right')
    <a class="btn btn-primary" href="{{ route('usuarios.show', $publicacion->usuario) }}">Ver Usuario</a>

    <h5 class="col-12 mt-3">Otras publicaciones del autor</h5>

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

@section('content-other')
    <script>
        function responder(comentarioId, nombre) {
            jQuery('#btn-cancelar-respuesta').text("Respondiendo a " + nombre);

            if (comentarioId) {
                jQuery('input[name=comentario_id]').val(comentarioId);

                jQuery('#btn-cancelar-respuesta').show();
            } else {
                jQuery('input[name=comentario_id]').val('');

                jQuery('#btn-cancelar-respuesta').hide();
            }
        }
    </script>
@endsection
