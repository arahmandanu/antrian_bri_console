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
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Daftar <span>Tombol</span></h5>
                                <a type="button" class="btn btn-success btn-lg" href="{{ route('tombol.create') }}">
                                    <i class="bx bx-list-plus"></i> Tambah Tombol</a>
                                <hr>
                                <!-- Table with stripped rows -->
                                <table class="table table-striped" id="buttonActor">
                                    <thead>
                                        <tr>
                                            <th>Kode Unit</th>
                                            <th width='11%'>Nomor Tombol</th>
                                            <th>Nama User</th>
                                            <th>Kode Tombol</th>
                                            <th width='13%'>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($buttonActors as $item)
                                            <tr>
                                                <td>{{ $item->codeService->Name }}</td>
                                                <td>{{ $item->counter_number }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->user_button_code }}</td>
                                                <td>
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic mixed styles example">
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="deleteButtonActor({{ $item->id }})">
                                                            <i class="bx bx-trash"></i> Hapus</button>
                                                        <a type="button" class="btn btn-primary"
                                                            href="{{ route('tombol.show', $item->id) }}">
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
            $('#buttonActor').DataTable({
                searching: true
            });

        });

        function deleteButtonActor(id) {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Aksi ini akan menghapus Currency!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, lanjutkan penghapusan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: "{{ route('tombol.destroy', '') }}" + '/' + id,
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
