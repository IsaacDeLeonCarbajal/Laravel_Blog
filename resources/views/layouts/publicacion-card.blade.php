<div class="p-3">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title }}</h5>
        </div>

        <div class="card-body">
            <h6 class="card-subtitle">{{ $subtitle }}</h6>

            <p class="card-text">{{ $content }}</p>

            <a href="{{ $route }}" class="btn btn-primary stretched-link">Ver</a>
        </div>

        <div class="card-footer">
            @foreach ($categs as $cat)
                <a class="btn btn-outline-secondary" href="#">{{ $cat->categoria }}</a>
            @endforeach
        </div>
    </div>
</div>
