@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Product</li>
                <li class="breadcrumb-item active">Suku Bunga</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Daftar <span>/Product</span></h5>

                                <div class="search-bar">
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <select class="form-select" aria-label="Default select example" id="product_id">
                                                <option selected value="">Open this select menu</option>
                                                @forelse ($masterProducts as $masterProduct)
                                                    <option value="{{ $masterProduct->id }}"
                                                        @if (isset($search) && $search->id == $masterProduct->id) selected @endif>
                                                        {{ Str::upper($masterProduct->name) }}
                                                    </option>
                                                @empty
                                                    <option value="">Master Product kosong</option>
                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="col-sm-6">
                                            <a type="button" class="btn btn-success btn-lg"
                                                href="{{ route('ConsoleCreateListSukuBunga') }}"><i
                                                    class="bx bxs-plus-square"></i>
                                                Suku Bunga</a>
                                        </div>
                                    </div>
                                </div><!-- End Search Bar -->

                                <hr>
                                <!-- Table with stripped rows -->
                                <table class="table table-striped" id="myTable">
                                    <thead>
                                        <tr>
                                            <th width="10%">Urutan</th>
                                            <th width="35%" style="word-wrap: break-word">Value</th>
                                            <th width="35%">Suku Bunga</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($search))
                                            @forelse ($search->productDetails as $item)
                                                <tr>
                                                    <td>{{ $item->display_number }}</td>
                                                    <td>{{ $item->value }}</td>
                                                    <td>{{ $item->suku_bunga }}</td>
                                                    <td style="text-align: center">
                                                        <div class="btn-group" role="group"
                                                            aria-label="Basic mixed styles example">
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="deleteProductDetail({{ $item->id }})">
                                                                <i class="bx bx-trash"></i> Hapus</button>
                                                            <a type="button" class="btn btn-primary" href="#">
                                                                <i class="bx bxs-pencil"></i> Edit</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                searching: true
            });

            $("#product_id").change(function() {
                if (!this.value) {
                    window.location.href = "{{ route('ConsoleIndexListSukuBunga') }}"
                };

                window.location.href = "{{ route('ConsoleIndexListSukuBunga') }}" + '?id=' + this.value;
            });
        });

        function deleteProductDetail(id) {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Aksi ini akan menghapus suku bunga!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, lanjutkan penghapusan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: "{{ route('ConsoleDeleteListSukuBunga', '') }}" + '/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data, textStatus, xhr) {
                            if (xhr.status == 201) {
                                Swal.fire({
                                    title: "Terhapus!",
                                    text: "Berhasil hapus data.",
                                    icon: "success"
                                });
                                setTimeout(location.reload(), 10000);
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal menghapus data",
                                    text: "Silahkan hubungi admin anda!",
                                });
                            }
                        }
                    });
                }
            });
        }
    </script>
@endsection
