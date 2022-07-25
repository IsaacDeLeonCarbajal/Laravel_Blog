{{-- @extends('layouts.master')

@section('title', 'Editar publicación')

@section('content-center')
    <form action="{{ route('publicaciones.updte') }}" method="POST">
        @csrf

        @method('put')

        <input class="form-control form-control-lg" type="text" name="titulo" placeholder="Titulo de la Publicación">

        @error('titulo')
            @component('layouts.alert')
                @slot('message', $message)
            @endcomponent
        @enderror

        <textarea class="form-control mt-5" name="contenido" rows="10" placeholder="Contenido"></textarea>

        @error('contenido')
            @component('layouts.alert')
                @slot('message', $message)
            @endcomponent
        @enderror

        <h4 class="mt-4">Categorias</h4>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 col-12">
            @foreach ($categorias as $cat)
                <label class="col-12 mb-2"><input class="me-2" type="checkbox" name="categorias[]" value="{{ $cat->id }}">{{ $cat->categoria }}</label>
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

        <button class="btn btn-primary mt-4" type="submit">Publicar</button>
    </form>
@endsection --}}
