<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BRI Console</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
</head>

<body class="d-flex flex-column min-vh-100 bg-primary-app">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-7 container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="video-container rounded">
                            {{-- video perlu cek settingan tampilan produk!!!! --}}
                            <video class="rounded" onloadedmetadata="this.muted = true" controls playsinline autoplay
                                muted loop id="myVideo" class="object-fit-none" src="{{ asset('storage/video.mp4') }}"
                                type="video/mp4">

                                unsupported video!
                            </video>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="title-info rounded border-top border-opacity-10">
                            <h1 class="fw-bolder text-white"> INFO PRODUK </h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="title-info rounded border-top border-opacity-10">
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <h1 class="fw-bolder text-center text-white title-info"> BRITAMA
                                            (RP) </h1>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div
                                        style="
                                    border-top:1px solid rgb(255, 255, 255);
                                border-left:1px solid rgb(255, 255, 255);
                                border-top-left-radius: 500px;
                                margin-top:5px;">
                                        <h1 class="fw-bolder text-center title-info" style="color: #faa901!important;">
                                            TARIF SUKU
                                            BUNGA (% PA) </h1>
                                    </div>

                                </div>

                                <div class="col-12 text-center">
                                    <div class="table-info parent-table-product table-auto-scroll">
                                        <table class="table my-table-product">
                                            <tbody>
                                                @for ($i = 0; $i < 20; $i++)
                                                    <tr>
                                                        <td>
                                                            <h2>tes {{ $i }}</h2>
                                                        </td>
                                                        <td>
                                                            <h2>{{ $i }} %%</h2>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-5 container-fluid">
                <div class="row right-bar position-relative">
                    <div class="col-md-12 container-fluid">
                        <div class="text-center">
                            <img src="{{ asset('images/logo_bri_2.png') }}" alt="Logo BRI" class="logo">
                            <h1 class="text-white">BRI UNIT COLOMADU</h1>
                        </div>
                    </div>

                    <div class="col-md-12 container-fluid">
                        <div class="row counter-parent">
                            <div class="col-5 text-center counter-div-left rounded">
                                <span class="counter-left counter-color counter-number">1</span>
                            </div>
                            <div class="col-7 text-center counter-div-right rounded">
                                <span class="counter-right counter-color counter-number">A05</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 container-fluid">
                        <div class="row counter-parent right-bar-title">
                            <div class="col-5 text-center title-div-left rounded">
                                <span>LOKET</span>
                            </div>
                            <div class="col-7 text-center title-div-right rounded">
                                <span>NO TIKET</span>
                            </div>
                        </div>
                    </div>

                    <div id="content-righ-bar">
                        {{-- INCOMING ANTRIAN --}}
                        <div class="col-md-12 container-fluid">
                            <div class="row counter-parent right-bar-counter rounded">
                                <div class="col-5 text-center right-bar-counter-left">
                                    <div class="parent-right-bar-counter-left rounded">
                                        <h1 class="text-white counter-number">02</h1>
                                    </div>
                                </div>

                                <div class="col-7 text-center rounded">
                                    <div class="parent-right-bar-counter-right rounded">
                                        <h1 class="text-white right-bar-counter-left counter-number">A001</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="row counter-parent right-bar-counter rounded">
                                <div class="col-5 text-center right-bar-counter-left">
                                    <div class="parent-right-bar-counter-left rounded">
                                        <h1 class="text-white counter-number">03</h1>
                                    </div>
                                </div>

                                <div class="col-7 text-center">
                                    <div class="parent-right-bar-counter-right rounded">
                                        <h1 class="text-white right-bar-counter-left counter-number">A003</h1>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 container-fluid">
                            <div class="row counter-parent rounded">
                                <div class="col-5 text-center ">
                                    <img src="{{ asset('images/logo_bri_2.png') }}" alt="Logo BRI" class="logo-call">
                                </div>
                                <div class="col-7 text-end align-middle">
                                    <h1 class="timer">20:19:33</h1>
                                    <hr class="timer border border-success border-3 opacity-100">
                                    <h1 class="timer">Minggu, 28 April 2024</h1>
                                </div>
                            </div>
                        </div>
                        {{-- END OF INCOMING ANTRIAN --}}

                        {{-- INI KETIKA ADA ANTRIAN MASUK --}}
                        {{-- <div class="col-md-12 container-fluid">
                        <div class="row counter-parent right-bar-caller">
                            <div class="col-12 caller-div position-relative">
                                <div class="col-12" style="padding: 10px">
                                    <p class="display-5">Antrian Nomor</p>
                                    <span class="display-1 counter-color">A001</span>
                                </div>

                                <div class="col-12" style="padding: 10px">
                                    <p class="display-5">Silahkan Menuju Ke</p>
                                    <span class="display-1 counter-color">02</span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                        {{-- END ANTRIAN MASUK --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('shared.footer')

    <script>
        $(document).ready(function() {

        });
    </script>
</body>

</html>
