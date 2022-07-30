<div class="card mb-2">
    <div class="card-header py-0">
        <h6 class="card-title mt-1">{{ $title }}</h6>
    </div>

    <div class="card-body py-0">
        <label class="col-12 card-text fs-6"><small>{{ $subtitle }}</small></label>

        <label class="col-12 card-text fs-6 lh-1"><small>{{ $content }}</small></label>

        <a href="{{ $route }}" class="btn btn-primary mb-1 mx-0 py-0 px-2 stretched-lin">Ver</a>
    </div>

    <div class="card-footer pt-0 pb-1">
        @foreach ($categs as $cat)
            <a class="btn btn-secondary mx-0 py-0 px-2" href="{{ route('home.categorias', $cat) }}"><small>{{ $cat->categoria }}</small></a>
        @endforeach
    </div>
</div>
