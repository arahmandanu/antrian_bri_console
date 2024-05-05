@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Master Iklan</li>
                <li class="breadcrumb-item">Iklan Gambar</li>
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
                                <h5 class="card-title">Daftar <span>Iklan Gambar</span></h5>
                                <a type="button" class="btn btn-success btn-lg"
                                   href="{{ route('ConsoleCreateCurrency') }}">
                                    <i class="bx bx-list-plus"></i> Tambah Iklan</a>
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
    </script>
@endsection
