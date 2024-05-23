<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Antrian BRI - Kios</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="{{ asset('images/logo_bri_2.png') }}" rel="icon">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset('css/kios.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body
    style="
    background: url({{ asset('bri/bri-background.jpg') }});
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;">
    <div style="overflow: hidden !important">
        <div class="row vh-100 vw-80 p-2">
            <div class="col-8">
                <div class="card bg-black">
                    <div class="card-body" style="height: 85vh">
                        <!-- Slides only carousel -->
                        <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade"
                            data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @forelse ($listGambar as $item)
                                    @if ($loop->first)
                                        <div class="carousel-item active" data-bs-interval="10000">
                                            <img src="{{ asset('iklan_kios') . '/' . $item }}"
                                                class="d-block w-100 img-fluid object-fit-fill" alt="..."
                                                style="height: 85vh">
                                        </div>
                                    @else
                                        <div class="carousel-item" data-bs-interval="10000">
                                            <img src="{{ asset('iklan_kios') . '/' . $item }}"
                                                class="d-block w-100 img-fluid object-fit-fill" alt="..."
                                                style="height: 85vh">
                                        </div>
                                    @endif
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <!-- End Slides only carousel-->
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12 card" style="background: #053a6c; height: 85vh">
                            <div class="row">
                                <div class="card-body">
                                    <div class="col-12 text-center pt-4">
                                        <img src="{{ asset('images/logo_white.png') }}" class="object-fit-contain"
                                            alt="Logo BRI"
                                            style="max-width: 100%;
                                                max-height: 100%;">

                                        <h1 class="text-white" style="font-family: kapakana;">
                                            Melayani
                                            Dengan
                                            Sepenuh Hati</h1>
                                        <hr style="color: #faa901; opacity: 100 !important">
                                        <h3 class="text-white">Silahkan Mengambil Nomor Antrian</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="h-100 scrollbar5"
                                style="padding-left: 20px !important; padding-right: 20px !important ; padding-bottom: 30px !important; overflow: auto !important"
                                id="list_buttons">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <footer class="bg-black for-footer mt-auto"
            style="position: absolute; width: 100%; overflow: hidden; bottom: 0">
            <div class="vw-20" style="border-top: solid #e08b16 7px">
                <marquee behavior="" direction="">
                    <h1 class="display-1">tess asdasds aasdsa </h1>
                </marquee>
            </div>
        </footer>
    </div>

    <script>
        $(document).ready(function() {
            getMainMenu();
        });

        function getMainMenu() {
            $('#list_buttons').load("{{ route('DashboardKiosMenuMainIndex') }}");
        }

        function getMenu(type) {
            if (type === 'A') {
                $('#list_buttons').load("{{ route('DashboardKiosTeller') }}");
            } else {
                $('#list_buttons').load("{{ route('DashboardKiosCs') }}");
            }
        }
    </script>
</body>

</html>
