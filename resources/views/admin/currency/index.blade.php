@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Currency</li>
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
                                <h5 class="card-title">Daftar <span>Currency</span></h5>
                                <a type="button" class="btn btn-success btn-lg"
                                    href="{{ route('ConsoleCreateCurrency') }}">
                                    <i class="bx bx-list-plus"></i> Tambah Currency</a>
                                <hr>
                                <!-- Table with stripped rows -->
                                <table class="table table-striped" id="myTable">
                                    <thead>
                                        <tr>
                                            <th width='5%'>Bendera</th>
                                            <th width='15%'>Kurs</th>
                                            <th width='15%'>Jual</th>
                                            <th width='15%'>Beli</th>
                                            <th width='15%'>Jual</th>
                                            <th width='15%'>Beli</th>
                                            <th width='10%'>Show</th>
                                            <th width='10%'>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($listCurrecy as $currency)
                                            <tr>
                                                <td>
                                                    <img style='height:3vh;width:6vh' src="{{ asset($currency->flag_url) }}"
                                                        class="rounded-circle" />
                                                </td>
                                                <td>{{ Str::upper($currency->name) }}</td>
                                                <td>{{ $currency->jual_a }}</td>
                                                <td>{{ $currency->beli_a }}</td>
                                                <td>{{ $currency->jual_b }}</td>
                                                <td>{{ $currency->beli_b }}</td>
                                                <td>
                                                    @if ($currency->show == '1')
                                                        <span class='badge bg-success'>yes</span>
                                                    @else
                                                        <span class='badge bg-danger'>no</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic mixed styles example">
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="deleteProductDetail()">
                                                            <i class="bx bx-trash"></i> Hapus</button>
                                                        <a type="button" class="btn btn-primary"
                                                            href="{{ route('ConsoleEditCurrency', $currency->id) }}">
                                                            <i class="bx bxs-pencil"></i> Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
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
