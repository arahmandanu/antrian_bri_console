@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Properties</li>
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

                                @include('admin.shared.error_validation')

                                <h5 class="card-title">
                                    Properties <span>Cabang / Unit</span>
                                </h5>
                                <hr>

                                <!-- Floating Labels Form -->
                                <form class="row g-3" method="POST" action="{{ route('ConsoleStoreProperties') }}">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input required type="text" class="form-control" id="floatingName"
                                                placeholder="Nama Perusahaan" value="{{ $settings->company_name ?? '' }}"
                                                name="company_name">
                                            <label for="floatingName">Nama Cabang / Unit</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input required type="text" class="form-control" id="floatingEmail"
                                                placeholder="Kode Perusahaan" value="{{ $settings->company_code ?? '' }}"
                                                name="company_code">
                                            <label for="floatingEmail">Kode Cabang / Unit</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <h5 class="card-title">Catatan</h5>
                                        <p class="badge bg-danger">
                                            Pastikan printer sudah di set sharing
                                        </p>
                                        <div class="col-md-12 pb-5">
                                            <img src="{{ asset('images/printer_settings.png') }}"
                                                alt="example printer settings!">
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingEmail"
                                                placeholder="Nama Printer Anda (cetak antrian)"
                                                value="{{ $settings->printer_name ?? '' }}" name="printer_name">
                                            <label for="floatingEmail">Nama Printer Anda (cetak antrian)</label>
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="col-md-12">
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">Tampilkan Product</legend>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="show_product"
                                                        id="show_product1" value="1"
                                                        @if (isset($settings) && $settings->show_product == '1') @checked(true) @endif>
                                                    <label class="form-check-label" for="show_product1">
                                                        ya
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="show_product"
                                                        id="show_product2" value="0"
                                                        @if (!isset($settings) || (isset($settings) && $settings->show_product == '0')) @checked(true) @endif>
                                                    <label class="form-check-label" for="show_product2">
                                                        tidak
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <hr>
                                    </div>

                                    <div class="col-md-12">
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">Tampilkan Currency</legend>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="show_currency"
                                                        id="show_currency1" value="1"
                                                        @if (isset($settings) && $settings->show_currency == '1') @checked(true) @endif>
                                                    <label class="form-check-label" for="show_currency1">
                                                        ya
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="show_currency"
                                                        id="show_currency2" value="0"
                                                        @if (!isset($settings) || (isset($settings) && $settings->show_currency == '0')) @checked(true) @endif>
                                                    <label class="form-check-label" for="show_currency2">
                                                        tidak
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <hr>
                                    </div>

                                    <div class="col-md-12">
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">Arah Teks Berjalan
                                                (Console)</legend>
                                            <div class="col-sm-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="footer_flow"
                                                        id="show_currency1" value="left"
                                                        @if (!isset($settings) || (isset($settings) && $settings->footer_flow == 'left')) @checked(true) @endif>
                                                    <label class="form-check-label" for="show_currency1">
                                                        kanan &rarr; kiri
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="footer_flow"
                                                        id="show_currency2" value="right"
                                                        @if (isset($settings) && $settings->footer_flow == 'right') @checked(true) @endif>
                                                    <label class="form-check-label" for="show_currency2">
                                                        kiri &rarr; kanan
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <hr>
                                    </div>

                                    <div class="col-md-12">
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">Arah Teks Berjalan
                                                (Kios)</legend>
                                            <div class="col-sm-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="footer_flow_kios" id="show_currency1" value="left"
                                                        @if (!isset($settings) || (isset($settings) && $settings->footer_flow_kios == 'left')) @checked(true) @endif>
                                                    <label class="form-check-label" for="show_currency1">
                                                        kanan &rarr; kiri
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="footer_flow_kios" id="show_currency2" value="right"
                                                        @if (isset($settings) && $settings->footer_flow_kios == 'right') @checked(true) @endif>
                                                    <label class="form-check-label" for="show_currency2">
                                                        kiri &rarr; kanan
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <hr>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Catatan</h5>
                                                <p>
                                                    Untuk iklan video silahkan ditambahkan saja ke folder
                                                    <span class="badge bg-danger">{{ public_path('video') }}</span>
                                                </p>
                                                <i>file: 'mov', 'mp4', 'flv', 'mpg', 'mpeg','mpv'</i>
                                                <hr>

                                                <p>
                                                    Untuk iklan Gambar silahkan ditambahkan saja ke folder
                                                    <span class="badge bg-danger">{{ public_path('iklan_image') }}</span>
                                                </p>
                                                <i>file: 'jpg', 'jpeg', 'giv', 'png'</i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
