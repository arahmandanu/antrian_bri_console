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
                                <table class="table datatable">
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
                                        @foreach ($listProducts as $listProduct)
                                            <tr>
                                                <td>{{ $listProduct->display_number }}</td>
                                                <td>{{ $listProduct->name }}</td>
                                                <td style="text-align: center">
                                                    @if ($listProduct->show == '1')
                                                        <span class='badge bg-success'>yes</span>
                                                    @else
                                                        <span class='badge bg-danger'>no</span>
                                                    @endif
                                                </td>
                                                <th style="text-align: center">
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic mixed styles example">
                                                        <button type="button" class="btn btn-danger">
                                                            <i class="bx bx-trash"></i> Hapus</button>
                                                        <a type="button" class="btn btn-primary"
                                                            href="{{ route('ConsoleShowProduct', $listProduct->id) }}">
                                                            <i class="bx bxs-pencil"></i> Edit</a>
                                                    </div>
                                                </th>
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
@endsection
