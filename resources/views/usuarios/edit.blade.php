@extends('layouts.master')

@section('title', 'Editar Usuario')

@section('content-center')
    <h1>Editar Usuario</h1>

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
            <button class="btn btn-primary ms-auto mt-3" type="submit">Actualizar Permisos</button>
        </div>
    </form>

    @if (!$usuario->publicaciones->isEmpty())
        {{-- Sólo mostrar si el usuario tiene publicaciones --}}

        <h3 class="col-12">Publicaciones</h3>

        <div class="row row-cols-1 row-cols-md-2 col-12">
            @foreach ($usuario->publicaciones as $pub)
                @component('layouts.publicacion-card', ['categs' => $pub->categorias])
                    @slot('id', $pub->id)

                    @slot('title', $pub->titulo)

                    @slot('subtitle', $pub->usuario->nombre . ' ' . $pub->usuario->apellido_paterno . ' ' . Str::substr($pub->updated_at, 0, 10) . ' ')

                    @slot('content', Str::substr($pub->contenido, 0, 150) . '...')

                    @slot('route', route('publicaciones.show', $pub))

                    <button class="btn btn-danger ms-2" type="button" onclick="eliminarPublicacion('{{ route('publicaciones.destroy', $pub) }}', '{{ $pub->titulo }}', {{ count($pub->respuestas) }});">Eliminar</button>
                @endcomponent
            @endforeach
        </div>
    @endif

    @if (!$usuario->comentarios->isEmpty())
        {{-- Sólo mostrar si el usuario tiene comentarios --}}

        <h3 class="col-12 my-4">Comentarios</h3>

        @foreach ($usuario->comentarios as $com)
            @component('layouts.comentario-view')
                @slot('title', $com->publicacion->titulo)

                @slot('subtitle', $com->updated_at)

                @slot('content', $com->contenido)

                <a class="btn btn-outline-primary" href="{{ route('publicaciones.show', $com->publicacion) }}">Ver publicación</a>

                <button class="btn btn-danger ms-2" type="button" onclick="eliminarComentario('{{ route('comentarios.destroy', $com) }}', {{ count($com->respuestas) }});">Eliminar</button>
            @endcomponent
        @endforeach
    @endif
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
