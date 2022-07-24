@foreach ($comentario->respuestas as $com)
    @if(!$com->comentario_id || $com->comentario_id == $comentario->id)
        <div class="col-12">
            <div class="d-flex flex-row col-12">
                <h5 class="me-auto">{{ $com->usuario->nombre . ' ' . $com->usuario->apellido_paterno . ' ' . $com->usuario->apellido_materno }}</h5>
            </div>

            <label class="text-muted">{{ $com->updated_at }} {{ isset($com->comentario_id)? ' en respuesta a ' . $com->comentario->usuario->nombre . ' ' . $com->comentario->usuario->apellido_paterno : '' }}</label>

            <p style="white-space: pre-wrap;">{{ $com->contenido }}</p>

            <button class="btn btn-outline-primary mb-3" onclick="responder({{ $com->id }}, '{{ $com->usuario->nombre }} {{ $com->usuario->apellido_paterno }}')">Responder</button>

            <div class="col ms-md-5">
                @include('layouts.comentario-list', ['comentario' => $com])
            </div>
        </div>
    @endif
@endforeach
