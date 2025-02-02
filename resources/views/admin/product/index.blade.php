@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">List Product</li>
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
                                <a type="button" class="btn btn-success btn-lg"
                                    href="{{ route('ConsoleCreateProduct') }}"><i class="bx bxs-save"></i> Tambah
                                    Product</a>
                                <hr>
                                <!-- Table with stripped rows -->
                                <table class="table table-striped" id="myTable">
                                    <thead>
                                        <tr>
                                            <th width="10%" style="word-wrap: break-word">Tampilan</th>
                                            <th width="60%">
                                                <b>N</b>ama
                                            </th>
                                            <th width="15%">Ditampilkan?</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listProducts as $listProduct)
                                            <tr>
                                                <td>{{ $listProduct->display_number }}</td>
                                                <td>{{ Str::upper($listProduct->name) }}</td>
                                                <td style="text-align: center">
                                                    @if ($listProduct->show == '1')
                                                        <span class='badge bg-success'>yes</span>
                                                    @else
                                                        <span class='badge bg-danger'>no</span>
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic mixed styles example">
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="deleteProduct({{ $listProduct->id }})">
                                                            <i class="bx bx-trash"></i> Hapus</button>
                                                        <a type="button" class="btn btn-primary"
                                                            href="{{ route('ConsoleShowProduct', $listProduct->id) }}">
                                                            <i class="bx bxs-pencil"></i> Edit</a>
                                                        <a type="button" class="btn btn-success"
                                                            href="{{ route('ConsoleIndexListSukuBunga', '') }}?id={{ $listProduct->id }}"><i
                                                                class="bx bx-search-alt"></i> Suku Bunga</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
        });

        function deleteProduct(id) {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Aksi ini akan menghapus product turunan suku bunga!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, lanjutkan penghapusan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: "delete/" + id,
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
