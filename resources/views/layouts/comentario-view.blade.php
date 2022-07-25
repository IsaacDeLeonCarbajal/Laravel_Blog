<div class="col-12 mt-4">
    <div class="d-flex flex-row col-12">
        <h5 class="me-auto">{{ $title }}</h5>

        @if (isset($route))
            <a class="btn btn-outline-secondary" href="{{ $route }}">Ver publicación</a>
        @endif

        {{ $slot }}
    </div>

    <label class="text-muted">{{ $subtitle }}</label>

    <p style="white-space: pre-wrap;">{{ $content }}</p>
</div>
