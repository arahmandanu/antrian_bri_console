<div class="d-grid gap-1 col-12 mx-auto h-100">
    <button onclick="getMenu('{{ $tellerCode }}')"
        style="background: #053a6c;
        border: 0;
        background: none;
        box-shadow: none;
        border-radius: 0px;
        margin: 0;
        border-bottom:none;
        background:linear-gradient(#faa901,#faa901) bottom /* left or right or else */ no-repeat;
        background-size:50% 1px">
        <h2 class="display-1 text-white" style="font-family: 'boxicons';">Teller</h2>
    </button>

    <button onclick="getMenu('{{ $CsCode }}')"
        style="background: #053a6c;
        border: 0;
        background: none;
        box-shadow: none;
        border-radius: 0px;  margin: 0;
        background:linear-gradient(#faa901,#faa901) bottom /* left or right or else */ no-repeat;
        background-size:50% 1px">
        <h2 class="display-2 text-white" style="font-family: 'boxicons';">Customer Service</h2>
    </button>

    @if (config('site.withPegadaian'))
        <button onclick="getMenu('{{ $PegadaianCode }}')"
            style="background: #053a6c;
        border: 0;
        background: none;
        box-shadow: none;
        border-radius: 0px;
        margin: 0">
            <h2 class="display-2 text-white" style="font-family: 'boxicons';">Pegadaian</h2>
        </button>
    @endif


    <style>
        .disabled-btn:focus {
            outline: none;
            box-shadow: none;
        }
    </style>

    @if (config('site.onlineApp', false))
        <button class="disabled-btn" style="background: #053a6c;  border: 0; align-self: self-end;"
            data-bs-toggle="modal" data-bs-target="#verticalycentered">
            <h4 class="align-bottom text-white"
                style="
    padding: 0 !important;
    margin: 0 !important; font-family: 'boxicons';"><i
                    class="bx bx-scan"></i> Scan Barcode</h4>
        </button>
    @endif
</div>
