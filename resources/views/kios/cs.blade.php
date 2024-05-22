<div class="d-grid gap-2 col-12 mx-auto">
    @forelse ($buttons as $button)
        <button class="btn btn-primary" type="button">
            <h1>{{ Str::upper($button->TrxName) }}</h1>
        </button>
    @empty
    @endforelse
</div>
