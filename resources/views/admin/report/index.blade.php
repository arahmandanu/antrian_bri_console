@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Report</li>
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
                                <h5 class="card-title">Reports</h5>
                            </div>
                        </div>
                    </div>
                    <!-- End Welcome -->

                    <!-- Welcome -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-body text-center">
                                    <blockquote class="blockquote mb-0">
                                        <p>Selamat Datang di console antrian,</p>
                                        <footer class="blockquote-footer">{{ auth()->user()->name }}<cite
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
