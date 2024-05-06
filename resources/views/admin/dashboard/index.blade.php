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

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Reports <span>/Today</span></h5>

                                <div class="card-body text-center">
                                    <blockquote class="blockquote mb-0">
                                        <p>Selamat Datang di console antrian,</p>
                                        <footer class="blockquote-footer">Someone famous in <cite
                                                title="Source Title">silahkan setting aplikasi sesuai kebutuhan anda</cite>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Reports -->
                </div>
            </div>
            <!-- End Left side columns -->
        </div>
    </section>
@endsection
