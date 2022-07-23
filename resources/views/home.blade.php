@extends('layouts.master')

@section('title', 'Blog')

@section('content-center')
    <h3 class="col-12">Publicaciones recientes</h3>

    @if (isset($categoria))
        <label class="my-2">Categoría: {{ $categoria->categoria }}</label>
    @endif

    <div class="row row-cols-1 row-cols-md-2 col-12">
        @foreach ($publicaciones as $pub)
            @component('layouts.publicacion-card', ['categs' => $pub->categorias])
                @slot('title', $pub->titulo)

                @slot('subtitle', $pub->usuario->nombre . ' ' . $pub->usuario->apellido_paterno . ' ' . Str::substr($pub->updated_at, 0, 10) . ' ')

                @slot('content', Str::substr($pub->contenido, 0, 150) . '...')

                @slot('route', route('publicaciones.show', $pub))
            @endcomponent
        @endforeach
    </div>

    <div class="d-flex">
        <span class="me-auto"></span>

        {{ $publicaciones->links() }}
    </div>
@endsection

@section('content-right')
    <h4>Categorías</h4>

    <div class="col-12">
        @foreach ($categorias as $cat)
            <a class="text-decoration-none" href="{{ route('home.categorias', $cat) }}">{{ $cat->categoria }}</a><br>
        @endforeach
    </div>
@endsection
