<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BRI Console</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="bg-primary-app">
        <div class="row">
            <div class="col-md-7">
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
                            <h1 class="fw-bolder text-white "> INFO PRODUK </h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="title-info rounded border-top border-opacity-10">
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <h2 class="fw-bolder text-white title-info" style="margin-left: 4%; "> BRITAMA
                                            (RP) </h2>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div
                                        style="
                                    border-top:1px solid rgb(255, 255, 255);
                                border-left:1px solid rgb(255, 255, 255);
                                border-top-left-radius: 500px;
                                margin-top:5px;">
                                        <h2 class="fw-bolder text-center title-info" style="color: #faa901!important;">
                                            TARIF SUKU
                                            BUNGA (% PA) </h2>
                                    </div>

                                </div>

                                <div class="col-12 text-center">
                                    <div class="table-info">
                                        <table class="table my-table-product">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h3>tes</h3>
                                                    </td>
                                                    <td>
                                                        <h3>tes</h3>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h3>tes</h3>
                                                    </td>
                                                    <td>
                                                        <h3>tes</h3>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-5">
                <div class="row">
                    <div class="col-md-12 for-logo">
                        <div class="text-center">
                            <img src="{{ asset('images/logo_bri_2.png') }}" alt="Logo BRI" class="logo">
                            <h1 class="text-white">BRI UNIT COLOMADU</h1>
                        </div>
                    </div>

                    <div class="col-md-12 ">
                        <div class="counter">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('shared.footer')

    <script>
        unmuteButton.addEventListener('click', function() {
            video.muted = false;
        });

        $(document).ready(function() {
            console.log($("#myVideo").prop("volume", 10));
        });
    </script>
</body>

</html>
