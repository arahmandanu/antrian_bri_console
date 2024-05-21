@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Welcome -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Reports <span>/Hari ini</span></h5>
                            </div>
                        </div>
                    </div>
                    <!-- End Welcome -->

                    @forelse ($current as $item)
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Antrian {{ $item->Name }} <span>| Hari ini</span></h5>

                                    <div class="d-flex align-items-center align-center text-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-account-circle-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $item->CurrentQNo }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @empty
                    @endforelse

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Antrian Belum Terpanggil <span>| Hari ini</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-account-circle-line"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $onQueue }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Welcome -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-body text-center">
                                    <blockquote class="blockquote mb-0 align-center text-center">
                                        <p>Selamat Datang di console antrian,</p>
                                        <footer class="blockquote-footer">{{ auth()->user()->name }} <cite
                                                title="Source Title">silahkan setting aplikasi sesuai kebutuhan anda</cite>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Welcome -->
                </div>
            </div>
            <!-- End Left side columns -->
        </div>
    </section>
@endsection
