<div class="d-grid gap-1 col-12 mx-auto h-100">
    <button onclick="getMenu('A')"
        style="background: #053a6c;
        border: 0;
        background: none;
        box-shadow: none;
        border-radius: 0px;
        margin: 0;
        border-bottom:none;
        background:linear-gradient(#faa901,#faa901) bottom /* left or right or else */ no-repeat;
        background-size:50% 1px">
        <h1 class="display-1 text-white" style="font-family: 'boxicons';">Teller</h1>
    </button>

    <button onclick="getMenu('B')"
        style="background: #053a6c;
        border: 0;
        background: none;
        box-shadow: none;
        border-radius: 0px;  margin: 0">
        <h1 class="display-2 text-white" style="font-family: 'boxicons';">Customer Service</h1>
    </button>

    <style>
        .disabled-btn:focus {
            outline: none;
            box-shadow: none;
        }
    </style>
    <button class="disabled-btn" style="background: #053a6c;  border: 0; align-self: self-end;" data-bs-toggle="modal"
        data-bs-target="#verticalycentered">
        <h1 class="align-bottom text-white"
            style="
        padding: 0 !important;
        margin: 0 !important; font-family: 'boxicons';"><i
                class="bx bx-scan"></i> Scan Barcode</h1>
    </button>
</div>
