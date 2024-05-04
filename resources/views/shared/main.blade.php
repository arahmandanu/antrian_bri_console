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
                                muted loop id="myVideo" class="object-fit-none" src="{{ asset('video/video.mp4') }}"
                                type="video/mp4">

                                unsupported video!
                            </video>
                        </div>
                    </div>
                </div>

                <div id='content_left_bar'>
                    <div class="row position-relative">
                        <div id="content_product" class="col position-absolute top-0 start-0 ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="title-info rounded border-top border-opacity-10">
                                        <h1 class="fw-bolder text-white"> INFO PRODUK </h1>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="carouselExampleControlsProduct" class="carousel slide carousel-fade">
                                        <div class="carousel-inner" id="container-parent-corousel">
                                            @forelse ($products as $item)
                                                <div class="carousel-item" id="corousel-parent"
                                                    data_id="{{ $loop->iteration }}">
                                                    <div class="title-info rounded border-top border-opacity-10">
                                                        <div class="row">

                                                            <div class="col-6">
                                                                <div>
                                                                    <h1
                                                                        class="fw-bolder text-center text-white title-info">
                                                                        {{ Str::upper($item->name) }}
                                                                    </h1>
                                                                </div>
                                                            </div>

                                                            <div class="col-6">
                                                                <div
                                                                    style="
                                                                border-top:1px solid rgb(255, 255, 255);
                                                                border-left:1px solid rgb(255, 255, 255);
                                                               border-top-left-radius: 500px;
                                                               margin-top:5px;">
                                                                    <h1 class="fw-bolder text-center title-info"
                                                                        style="color: #faa901!important;">
                                                                        TARIF SUKU
                                                                        BUNGA (% PA) </h1>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 text-center">
                                                                <div
                                                                    class="table-info parent-table-product table-auto-scroll">
                                                                    <table class="table my-table-product">
                                                                        <tbody>
                                                                            @forelse ($item->productDetails as $productDetail)
                                                                                <tr>
                                                                                    <td>
                                                                                        <h2>{{ Str::upper($productDetail->value) }}
                                                                                        </h2>
                                                                                    </td>
                                                                                    <td>
                                                                                        <h2>{{ Str::upper($productDetail->suku_bunga) }}
                                                                                        </h2>
                                                                                    </td>
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td>
                                                                                        <h2>-</h2>
                                                                                    </td>
                                                                                    <td>
                                                                                        <h2>-</h2>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="carousel-item" id="corousel-parent" data_id="1">
                                                    <div class="title-info rounded border-top border-opacity-10">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div>
                                                                    <h1
                                                                        class="fw-bolder text-center text-white title-info">
                                                                        -
                                                                    </h1>
                                                                </div>

                                                            </div>
                                                            <div class="col-6">
                                                                <div
                                                                    style="
                                                                border-top:1px solid rgb(255, 255, 255);
                                                            border-left:1px solid rgb(255, 255, 255);
                                                            border-top-left-radius: 500px;
                                                            margin-top:5px;">
                                                                    <h1 class="fw-bolder text-center title-info"
                                                                        style="color: #faa901!important;">
                                                                        TARIF SUKU
                                                                        BUNGA (% PA) </h1>
                                                                </div>

                                                            </div>

                                                            <div class="col-12 text-center">
                                                                <div
                                                                    class="table-info parent-table-product table-auto-scroll">
                                                                    <table class="table my-table-product">
                                                                        <tbody>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="content_currency" class="col position-absolute top-0 start-0 invisible">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="title-info rounded border-top border-opacity-10">
                                        <h1 class="fw-bolder text-white"> BANK NOTE DD/TT </h1>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="title-info rounded border-top border-opacity-10">
                                        <table id="table table-currency" class="table table-currency">
                                            <thead>
                                                <tr>
                                                    <th width="20%">
                                                        <h2 class="fw-bolder text-white">KURS</h2>
                                                    </th>
                                                    <th width="20%">
                                                        <h2 class="fw-bolder text-white">JUAL</h2>
                                                    </th>
                                                    <th width="20%">
                                                        <h2 class="fw-bolder text-white">BELI</h2>
                                                    </th>
                                                    <th width="20%">
                                                        <h2 class="fw-bolder text-white">JUAL</h2>
                                                    </th>
                                                    <th width="20%">
                                                        <h2 class="fw-bolder text-white">BELI</h2>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse ($currencies as $currency)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex flex-row text-center">
                                                                <div class="p-2"><img
                                                                        src="{{ asset($currency->flag_url) }}"
                                                                        style='height:3vh;width:6vh' alt="flag"
                                                                        class="rounded-circle"></div>
                                                                <div class="p-2">
                                                                    <h3 class="text-white">
                                                                        {{ Str::upper($currency->name) }}</h3>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <h3>{{ $currency->jual_a }}</h3>
                                                        </td>
                                                        <td>
                                                            <h3>{{ $currency->beli_a }}</h3>
                                                        </td>
                                                        <td>
                                                            <h3>{{ $currency->jual_b }}</h3>
                                                        </td>
                                                        <td>
                                                            <h3>{{ $currency->beli_b }}</h3>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5">
                                                            <h2>-</h2>
                                                        </td>
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
                                    <img src="{{ asset('images/logo_bri_2.png') }}" alt="Logo BRI"
                                        class="logo-call">
                                </div>
                                <div class="col-7 text-end align-middle">
                                    <h1 class="timer display-time">20:19:33</h1>
                                    <hr class="timer border border-success border-3 opacity-100">
                                    <h1 class="timer" id="display-date">Minggu, 28 April 2024</h1>
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
            product_corousel(true);
            showTime();
            updateDate();
        });

        // Time
        function showTime() {
            const displayTime = document.querySelector(".display-time");
            let time = new Date();
            displayTime.innerText = time.toLocaleTimeString("en-US", {
                hour12: false
            });
            setTimeout(showTime, 1000);
        }

        // Date
        function updateDate() {
            let today = new Date();

            let dayName = today.getDay(),
                dayNum = today.getDate(),
                month = today.getMonth(),
                year = today.getFullYear();

            const months = [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember"
            ];
            const dayWeek = [
                "Senin",
                "Selasa",
                "Rabu",
                "Kamis",
                "Jum'at",
                "Sabtu",
                "Minggu",
            ];
            // value -> ID of the html element
            const IDCollection = ["day", "daynum", "month", "year"];

            // return value array with number as a index
            const val = [dayWeek[dayName], dayNum, months[month], year];
            console.log(val, document.getElementById('display-date'));
            document.getElementById('display-date').innerHTML = (val[0] + ", " + val[1] + " " + val[2] + " " + val[3]);
        }

        function run_next_corousel(ids, current_id) {
            function nestedFunction(ids, current_id) {
                if (ids[0] === undefined) {
                    return product_corousel(false);
                }

                setTimeout(() => {
                    $('#carouselExampleControlsProduct').carousel('next');

                    setTimeout(() => {
                        var current_id = ids.shift();
                        run_next_corousel(ids, current_id);
                    }, 1000);
                }, 1000);
            }

            var current_scroll_table = $("div#corousel-parent[data_id=" + current_id + "] .table-auto-scroll");
            var st = current_scroll_table.scrollTop();
            var sb = current_scroll_table.prop("scrollHeight") - current_scroll_table.innerHeight();
            current_scroll_table.animate({
                scrollTop: st < sb / 2 ? sb : 0
            }, {
                duration: 15000,
                complete: function() {
                    nestedFunction(ids, current_id)
                }
            });
        }

        function product_corousel(with_enabled) {
            const containerProduct = $("div#carouselExampleControlsProduct");
            if (containerProduct.length) {
                var firstCorousel = $('div#carouselExampleControlsProduct div#corousel-parent:first-child')
                if (with_enabled == true) {
                    firstCorousel.addClass('active');
                }

                var current_id = firstCorousel.attr('data_id');
                var listCorousel = $('div#corousel-parent');

                var all = $('div#corousel-parent');
                var new_map = $.map(all, function(elementOrValue, indexOrKey) {
                    if (elementOrValue.getAttribute('data_id') != current_id) return elementOrValue
                        .getAttribute(
                            'data_id');
                });

                var $el = firstCorousel.children().children().children().children('.table-auto-scroll');
                var st = $el.scrollTop();
                var sb = $el.prop("scrollHeight") - $el.innerHeight();

                $el.animate({
                    scrollTop: st < sb / 2 ? sb : 0
                }, {
                    duration: 10000,
                    complete: function() {
                        run_next_corousel(new_map, current_id)
                    }
                });
            }
        }
    </script>
</body>

</html>
