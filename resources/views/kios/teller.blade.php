<div class="d-grid gap-2 col-12 mx-auto">
    @forelse ($buttons as $button)
        <button class="btn btn-primary" type="button" onclick="createAntrianTeller('A',{{ $button->TrxCode }})">
            <h1>{{ Str::upper($button->TrxName) }}</h1>
        </button>
    @empty
    @endforelse

    <button class="btn btn-danger" type="button" onclick="getMainMenu()">
        <h1>KEMBALI KE MENU UTAMA</h1>
    </button>
</div>

<script>
    function createAntrianTeller(unit_service, code) {
        $.ajax({
            type: "POST",
            url: "{{ route('DashboardKiosCreateAntrianTeller') }}",
            data: {
                'trx_param': code,
                'unit_service': unit_service,
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data, textStatus, xhr) {
                if (xhr.status == 201) {
                    getMainMenu()
                }
            },
            complete: function(data) {
                if (data.status == 503 || data.status == 422) {
                    alertDevice(data.responseJSON.message);
                } else {
                    console.log(data.responseJSON);
                }
            }
        });
    }
</script>
