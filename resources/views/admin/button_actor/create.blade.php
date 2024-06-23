@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Tombol</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Tambah <span>/Tombol</span></h5>
                                <hr>

                                @include('admin.shared.error_validation')

                                <form enctype="multipart/form-data" class="row g-3" method="POST"
                                    action="{{ route('tombol.store') }}">
                                    @csrf

                                    <div class="col-12">
                                        <label for="inputEmail4" class="form-label">Kode Unit</label>
                                        <select class="form-select" onchange="getCounterNumber(this)" required
                                            aria-label="Default select example" name="unit_service">
                                            <option selected value="">Open this select menu</option>
                                            @forelse ($codeServices as $codeService)
                                                <option value="{{ $codeService->Initial }}"><b>{{ $codeService->Name }}</b>
                                                </option>
                                            @empty
                                                <option value="">
                                                    <b>Kode unit kosong!</b>
                                                </option>
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label">Nama User</label>
                                        <input type="text" required class="form-control" id="inputNanme4" name="name"
                                            placeholder="Silahkan inputkan nama user">
                                    </div>

                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label">Kode Tombol User</label>
                                        <input type="text" required class="form-control" id="inputNanme4"
                                            name="user_button_code" placeholder="Silahkan inputkan nama user">
                                    </div>

                                    <div class="col-12">
                                        <label for="inputEmail4" class="form-label">Nomor Kounter</label>
                                        <select class="form-select" required aria-label="Default select example"
                                            name="counter_number" id="counter_number">
                                            <option value="">-- Silahkan pilih Kode Unit dahulu --</option>
                                        </select>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        function getCounterNumber(object) {
            var value = object.value;
            $.ajax({
                type: "GET",
                url: "{{ route('ConsoleTombolGetCounterNumber', '') }}" + "/" + value,
                data: {
                    'currentId': null
                },
                dataType: "json",
                success: function(data, textStatus, xhr) {
                    if (xhr.status == 200) {
                        html = ""
                        if (data.display_number.length > 0) {
                            data.display_number.forEach(element => {
                                html += "<option value=" + element + ">" + element +
                                    "</option>";
                            });
                        } else {
                            html +=
                                "<option value=''>Data Kosong ! Silahkan hapus data yang lain terlebih dahulu atau hubungi admin untuk menaikkan nilai maksimal display!</option>";
                        }
                        $('select#counter_number').children('option:not(:first)').remove();
                        $("select#counter_number").append(html);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Something wrong with our system!",
                            text: "Silahkan hubungi admin anda!",
                        });
                    }
                }
            });
        }
    </script>
@endsection
