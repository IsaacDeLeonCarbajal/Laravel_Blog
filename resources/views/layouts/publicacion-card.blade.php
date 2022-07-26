<div class="p-3">
    <div class="card">
        @if(isset($id))
            <img class="card-img-top" src="{{ asset('storage/publicaciones/' . $id . '.png') }}" onerror="this.style.display='none'">
        @endif

        <div class="card-header">
            <h5 class="card-title">{{ $title }}</h5>
        </div>

        <div class="card-body">
            <h6 class="card-subtitle">{{ $subtitle }}</h6>

            <p class="card-text" style="white-space: pre-wrap;">{{ $content }}</p>

            <a href="{{ $route }}" class="btn btn-primary {{ Str::length($slot) ? '' : 'stretched-link' }}">Ver</a>

            {{ $slot }}
        </div>

        <div class="card-footer">
            @foreach ($categs as $cat)
                <a class="btn btn-outline-secondary" href="{{ route('home.categorias', $cat) }}">{{ $cat->categoria }}</a>
            @endforeach
        </div>
    </div>
</div>
