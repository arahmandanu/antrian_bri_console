<div class="d-flex" style="height: 100%; weight: 100%">
    <div id="showLoading"
        style="width: 100%; height: 100%; text-align: center; align-content: space-around; display: none !important"
        class="text-center">
        <div class="spinner-border text-light" style="width: 100px; height: 100px;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="d-grid gap-2 col-12 mx-auto" id="menuList">
        @forelse ($buttons as $button)
            <button class="btn btn-primary" type="button" onclick="createAntrianCs('B', {{ $button->TrxCode }})">
                <h1>{{ Str::upper($button->TrxName) }}</h1>
            </button>
        @empty
        @endforelse

        <button class="btn btn-danger" type="button" onclick="getMainMenu()">
            <h1>KEMBALI KE MENU UTAMA</h1>
        </button>
    </div>
</div>

<script>
    function createAntrianCs(unit_service, code) {
        var loading = $('div#showLoading');
        var menuList = $('div#menuList');
        menuList.addClass('d-none');
        loading.css("display", "");


        $.ajax({
            type: "POST",
            url: "{{ route('DashboardKiosCreateAntrianTeller') }}",
            data: {
                'trx_param': code,
                'unit_service': unit_service,
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data, textStatus, xhr) {},
            complete: function(data) {
                if (data.status == 503 || data.status == 422) {
                    alertDevice(data.responseJSON.message);
                } else {
                    console.log(data.responseJSON);
                }

                getMainMenu()
            }
        });
    }
</script>
