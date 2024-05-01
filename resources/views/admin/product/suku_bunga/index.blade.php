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
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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
