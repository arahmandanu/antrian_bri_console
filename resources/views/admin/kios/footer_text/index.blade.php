@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Kios</li>
                <li class="breadcrumb-item active">Text Berjalan</li>
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
                                <h5 class="card-title">
                                    Kios <span>Text Berjalan</span>
                                </h5>

                                <a type="button" class="btn btn-success btn-lg"
                                    href="{{ route('ConsoleCreateKiosFooterText') }}">
                                    <i class="bx bx-list-plus"></i> Tambah Text Berjalan</a>
                                <hr>

                                @include('admin.shared.error_validation')

                                <div class="card">
                                    <div class="card-body">
                                        <!-- Floating Labels Form -->
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th width='50%'>Text</th>
                                                    <th>Nomor Tampilan</th>
                                                    <th>Ditampilkan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @forelse ($footers as $item)
                                                    <tr>
                                                        <td>{{ Str::upper($item->text) }}</td>
                                                        <td>{{ $item->display_number }}</td>
                                                        <td>
                                                            @if ($item->show == '1')
                                                                <span class='badge bg-success'>yes</span>
                                                            @else
                                                                <span class='badge bg-danger'>no</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                aria-label="Basic mixed styles example">
                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="deleteFooter({{ $item->id }})">
                                                                    <i class="bx bx-trash"></i> Hapus</button>
                                                                <a type="button" class="btn btn-primary"
                                                                    href="{{ route('ConsoleEditKiosFooterText', $item->id) }}">
                                                                    <i class="bx bxs-pencil"></i> Edit</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4">No Data Found!</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function deleteFooter(id) {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Aksi ini akan menghapus text berjalan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, lanjutkan penghapusan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: "{{ route('ConsoleDestroyKiosFooterText', '') }}" + "/" + id,
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
                                setTimeout(location.reload(), 1000);
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
