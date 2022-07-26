<div class="col-12 mt-4">
    <div class="d-flex flex-row col-12">
        <h5 class="me-auto">{{ $title }}</h5>

        {{ $slot }}
    </div>

    <label class="text-muted">{{ $subtitle }}</label>

    <p style="white-space: pre-wrap;">{{ $content }}</p>
</div>
