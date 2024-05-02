@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Currnecy</li>
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
                                <h5 class="card-title">Tambah <span>/Currency</span></h5>
                                <hr>

                                @include('admin.shared.error_validation')

                                <form enctype="multipart/form-data" class="row g-3" method="POST"
                                    action="{{ route('ConsoleStoreCurrency') }}">
                                    @csrf

                                    <div class="col-12">
                                        <label for="inputNumber" class="col-sm-2 col-form-label">Gambar Bendera</label>
                                        <div class="col-sm-12">
                                            <input required class="form-control" type="file"
                                                accept="image/png, image/gif, image/jpeg, image/jpg" id="formFile"
                                                name="flag">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label">Nama Kurs</label>
                                        <input type="text" required class="form-control" id="inputNanme4" name="name"
                                            placeholder="Silahkan inputkan nama Kurs">
                                    </div>

                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label">Jual a</label>
                                        <input type="text" required class="form-control" id="inputNanme4" name="jual_a"
                                            placeholder="Silahkan inputkan Jual a">
                                    </div>

                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label">Beli a</label>
                                        <input type="text" required class="form-control" id="inputNanme4" name="beli_a"
                                            placeholder="Silahkan inputkan Beli a">
                                    </div>

                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label">Jual b</label>
                                        <input type="text" required class="form-control" id="inputNanme4" name="jual_b"
                                            placeholder="Silahkan inputkan Jual b">
                                    </div>

                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label">Beli b</label>
                                        <input type="text" required class="form-control" id="inputNanme4" name="beli_b"
                                            placeholder="Silahkan inputkan Beli b">
                                    </div>

                                    <div class="col-12">
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">Ditampilkan?</legend>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="show"
                                                        id="show1" value="1" checked>
                                                    <label class="form-check-label" for="show1">
                                                        Show
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="show"
                                                        id="show2" value="0">
                                                    <label class="form-check-label" for="show2">
                                                        hide
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
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
