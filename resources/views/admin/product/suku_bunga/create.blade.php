@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Product</li>
                <li class="breadcrumb-item active">Suku Bunga</li>
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
                                <h5 class="card-title">Tambah <span>/Suku Bunga</span></h5>
                                <hr>

                                @include('admin.shared.error_validation')

                                <form class="row g-3" method="POST" action="{{ route('ConsoleStoreListSukuBunga') }}">
                                    @csrf

                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label">Nama Product</label>
                                        <select required class="form-select" aria-label="Default select example"
                                            id="product_id" name="master_product_id">
                                            <option selected value="">Open this select menu</option>
                                            @forelse ($masterProducts as $masterProduct)
                                                <option value="{{ $masterProduct->id }}">
                                                    {{ Str::upper($masterProduct->name) }}
                                                </option>
                                            @empty
                                                <option value="">Master Product kosong</option>
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label">Nilai</label>
                                        <input type="text" required class="form-control" id="inputNanme4" name="value"
                                            placeholder="Silahkan inputkan nama product">
                                    </div>

                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label">Suku Bunga</label>
                                        <input type="text" required class="form-control" id="inputNanme4"
                                            name="suku_bunga" placeholder="Silahkan inputkan nama product">
                                    </div>

                                    <div class="col-12">
                                        <label for="inputEmail4" class="form-label">Urutan Tampilan</label>
                                        <select class="form-select" required aria-label="Default select example"
                                            name="display_number" id="prodct_display_number">
                                            <option value="">-- Silahkan pilih product dahulu --</option>
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
        $("#product_id").change(function() {
            if (!this.value) return;

            var product_id = this.value;
            $.ajax({
                type: "GET",
                url: "{{ route('ConsoleGetDisplayNumberSukuBunga') }}",
                data: {
                    "product_id": product_id
                },
                dataType: "json",
                success: function(data, textStatus, xhr) {
                    console.log(data);
                    console.log(data.display_number.constructor.name);
                    console.log(data.display_number.length);
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
                        console.log(html);
                        $('select#prodct_display_number').children('option:not(:first)').remove();
                        $("select#prodct_display_number").append(html);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Something wrong with our system!",
                            text: "Silahkan hubungi admin anda!",
                        });
                    }
                }
            });
        });
    </script>
@endsection
