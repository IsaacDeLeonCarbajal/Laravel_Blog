@extends('layouts.master')

@section('title')
    Usuario {{ $usuario->nombre }}
@endsection

@section('content-center')
    <h1 class="col-12 text-center">{{ $usuario->nombre }} {{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno }}</h1>

    <label class="text-muted mt-4">Correo electrónico: {{ $usuario->email }}</label>

    <div class="col-12 mt-4">
        <h3 class="col-12">Publicaciones</h3>

        <div class="row row-cols-1 row-cols-md-2 col-12">
            @foreach ($usuario->publicaciones as $pub)
                @component('layouts.publicacion-card', ['categs' => $pub->categorias])
                    @slot('title', $pub->titulo)

                    @slot('subtitle', $pub->usuario->nombre . ' ' . $pub->usuario->apellido_paterno . ' ' . Str::substr($pub->updated_at, 0, 10) . ' ')

                    @slot('content', Str::substr($pub->contenido, 0, 150) . '...')

                    @slot('route', route('publicaciones.show', $pub))

                    <a class="btn btn-secondary ms-2" href="{{ route('publicaciones.edit', $pub) }}">Editar</a>
                    
                    <button class="btn btn-danger ms-2" type="button" onclick="eliminarPublicacion('{{ route('publicaciones.destroy', $pub) }}', '{{ $pub->titulo }}', {{ count($pub->respuestas) }});">Eliminar</button>

                    @endcomponent
            @endforeach
        </div>

        <h3 class="col-12 my-4">Comentarios</h3>

        @foreach ($usuario->comentarios as $com)
            @component('layouts.comentario-view')
                @slot('title', $com->publicacion->titulo)

                @slot('subtitle', $com->updated_at)

                @slot('content', $com->contenido)

                <a class="btn btn-outline-primary" href="{{ route('publicaciones.show', $com->publicacion) }}">Ver publicación</a>

                <a class="btn btn-secondary ms-2" href="{{ route('comentarios.edit', $com) }}">Editar</a>

                <button class="btn btn-danger ms-2" type="button" onclick="eliminarComentario('{{ route('comentarios.destroy', $com) }}', {{ count($com->respuestas) }});">Eliminar</button>
            @endcomponent
        @endforeach
    </div>
@endsection

@section('content-right')
    <a class="btn btn-primary" href="{{ route('publicaciones.create') }}">Nueva publicación</a>
@endsection

@section('content-other')
    <dialog id="dlg-eliminar-publicacion">
        <form id="form-eliminar-publicacion" class="text-center" action="" method="POST">
            @csrf

            @method('delete')

            <h2>¿Realmente desea eliminar esta publicación?</h2>

            <div class="d-flex flex-column fs-5">
                <label class="mt-2">Se eliminará la publicación <span id="titulo-publicacion"></span></label>

                <label class="mt-2">Se eliminarán también los <span id="cant-respuestas-publicacion"></span> comentarios de la publicación</label>

                <label class="mt-2">Recuerde que esta acción es irreversible</label>
            </div>

            <div class="row mt-4">
                <button class="col-6 col-md-3 offset-md-2 btn btn-secondary" type="button" onclick="document.getElementById('dlg-eliminar-publicacion').close();">Cancelar</button>

                <button class="col-6 col-md-3 offset-md-2 btn btn-danger" type="submit">Eliminar</a>
            </div>
        </form>
    </dialog>

    <dialog id="dlg-eliminar-comentario">
        <form id="form-eliminar-comentario" class="text-center" action="" method="POST">
            @csrf

            @method('delete')

            <h2>¿Realmente desea eliminar este comentario?</h2>

            <div class="d-flex flex-column fs-5">
                <label class="mt-2">Se eliminarán también las <span id="cant-respuestas-comentario"></span> respuestas del comentario</label>

                <label class="mt-2">Recuerde que esta acción es irreversible</label>
            </div>

            <div class="row mt-4">
                <button class="col-6 col-md-3 offset-md-2 btn btn-secondary" type="button" onclick="document.getElementById('dlg-eliminar-comentario').close();">Cancelar</button>

                <button class="col-6 col-md-3 offset-md-2 btn btn-danger" type="submit">Eliminar</a>
            </div>
        </form>
    </dialog>

    <script>
        function eliminarPublicacion(action, tituloPub, cantResps) {
            jQuery('#titulo-publicacion').text(tituloPub);

            jQuery('#cant-respuestas-publicacion').text(cantResps);

            document.getElementById('form-eliminar-publicacion').action = action;

            document.getElementById('dlg-eliminar-publicacion').showModal();
        }

        function eliminarComentario(action, cantResps) {
            jQuery('#cant-respuestas-comentario').text(cantResps);

            document.getElementById('form-eliminar-comentario').action = action;

            document.getElementById('dlg-eliminar-comentario').showModal();
        }
    </script>
@endsection
