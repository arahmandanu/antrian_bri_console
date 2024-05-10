<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BRI Console</title>

    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/simplemarquee.js') }}"></script>
</head>

<body class="d-flex flex-column min-vh-100 bg-primary-app">
    <div class="container-fluid ps-3 pe-3 pt-3">
        <div class="row ">
            <div class="col-md-7 container-fluid">
                <div class="row">
                    <div id="carouselExampleControlsIklan" class="carousel slide carousel-fade">
                        <div class="carousel-inner" id="corousel_iklan_parent">
                            {{-- IKLAN VIDEO --}}
                            @forelse ($videos as $item)
                                @if ($loop->first)
                                    <div class="carousel-item active">
                                        <div class="col-md-12" id="parent-container-video" data_type="video">
                                            <div
                                                class="video-container-{{ $show_product || $show_currency ? 'minimize' : 'full' }} rounded">
                                                <video class="rounded" onloadedmetadata="this.muted = true" controls
                                                    playsinline muted id="myVideo" class="object-fit-none"
                                                    src="{{ asset("video/$item ") }}" type="video/mov">

                                                    unsupported video! {{ $item }}
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <div class="col-md-12" id="parent-container-video" data_type="video">
                                            <div
                                                class="video-container-{{ $show_product || $show_currency ? 'minimize' : 'full' }} rounded">
                                                <video class="rounded" onloadedmetadata="this.muted = true" controls
                                                    playsinline muted id="myVideo" class="object-fit-none"
                                                    src="{{ asset("video/$item ") }}" type="video/mov">

                                                    unsupported video! {{ $item }}
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                @if (empty($images))
                                    <div class="col-md-12" id="parent-container-video">
                                        <div
                                            class="video-container-{{ $show_product || $show_currency ? 'minimize' : 'full' }} rounded">
                                            <video src="#" id="myVideo"></video>
                                        </div>
                                    </div>
                                @endif
                            @endforelse
                            {{-- END OF IKLAN VIDEO --}}

                            {{-- IKLAN GAMBAR --}}
                            @forelse ($images as $item)
                                @if ($loop->first)
                                    <div class="carousel-item @if (empty($videos)) active @endif">
                                        <div class="col-md-12" id="parent-container-video" data_type="image">
                                            <div
                                                class="video-container-{{ $show_product || $show_currency ? 'minimize' : 'full' }} rounded">
                                                <img class="object-fit-contain" id="myImage"
                                                    src="{{ asset("iklan_image/$item ") }}">

                                                unsupported video! {{ $item }}
                                                </img>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <div class="col-md-12" id="parent-container-video" data_type="image">
                                            <div
                                                class="video-container-{{ $show_product || $show_currency ? 'minimize' : 'full' }} rounded">
                                                <img class="object-fit-contain" id="myImage"
                                                    src="{{ asset("iklan_image/$item ") }}">

                                                unsupported video! {{ $item }}
                                                </img>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                            @endforelse
                        </div>

                        {{-- END OF IKLAN GAMBAR --}}
                    </div>
                </div>

                @if ($show_product || $show_currency)
                    <div id='content_left_bar'>
                        <div class="row position-relative">
                            @if ($show_product)
                                <div id="content_product" class="col position-absolute top-0 start-0">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="title-info rounded border-top border-opacity-10">
                                                <h1 class="fw-bolder text-white"> INFO PRODUK </h1>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="carouselExampleControlsProduct"
                                                class="carousel slide carousel-fade">
                                                <div class="carousel-inner" id="container-parent-corousel">
                                                    @forelse ($products as $item)
                                                        <div class="carousel-item" id="corousel-parent"
                                                            data_id="{{ $loop->iteration }}">
                                                            <div
                                                                class="title-info rounded border-top border-opacity-10">
                                                                <div class="row">

                                                                    <div class="col-6">
                                                                        <div>
                                                                            <h1 class="fw-bolder text-white title-info">
                                                                                {{ Str::upper($item->name) }}
                                                                            </h1>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6" style="align-content: end">
                                                                        <h1 class="fw-bolder "
                                                                            style="color: #faa901!important; font-size: 25px; float: right">
                                                                            TARIF SUKU
                                                                            BUNGA (% PA) </h1>
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
                                                            <div
                                                                class="title-info rounded border-top border-opacity-10">
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
                                                                        <h1 class="fw-bolder text-center title-info"
                                                                            style="color: #faa901!important;">
                                                                            TARIF SUKU
                                                                            BUNGA (% PA) </h1>
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
                            @endif

                            @if ($show_currency)
                                <div id="content_currency"
                                    class="col position-absolute top-0 start-0 {{ $show_both ? 'invisible' : '' }}">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="title-info rounded border-top border-opacity-10">
                                                <h1 class="fw-bolder text-white"> BANK NOTE DD/TT </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <div class="table-currency rounded border-top border-opacity-10">
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
                                                                                style='height:3vh;width:6vh'
                                                                                alt="flag" class="rounded-circle">
                                                                        </div>
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
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-5 container-fluid">
                <div class="row right-bar position-relative">
                    <div class="col-md-12 p-2">
                        <div class="row">
                            <div class="col-5">
                                <img src="{{ asset('images/logo_white.png') }}" class="object-fit-contain"
                                    alt="Logo BRI"
                                    style="max-width: 100%;
                                    max-height: 100%;">
                            </div>
                            <div class="col-7 text-center align-content-center">
                                <div>
                                    <h1 class="text-white fw-bolder display-6">
                                        {{ $company_name ?? 'Nama Cabang Kosong' }}
                                    </h1>
                                </div>
                                <h1 class="text-white" style="font-family: kapakana;">Melayani
                                    Dengan
                                    Sepenuh Hati</h1>

                                {{-- <div class="text-center"> --}}
                                {{-- <img src="{{ asset('images/logo_bri_2.png') }}" alt="Logo BRI" class="logo"> --}}
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 container-fluid">
                        <div class="row counter-parent">
                            <div class="col-5 text-center counter-div-left">
                                <span class="counter-left counter-color counter-number" id="history_1_left">
                                    @if (array_key_exists(0, $historyQueues))
                                        {{ $historyQueues[0]->Counter }}
                                    @else
                                        <span class="invisible">-</span>
                                    @endif
                                </span>
                            </div>
                            <div class="col-7 text-center counter-div-right">
                                <span class="counter-right counter-color counter-number" id="history_1_right">
                                    @if (array_key_exists(0, $historyQueues))
                                        {{ $historyQueues[0]->SeqNumber }}
                                    @else
                                        <span class="invisible">-</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 container-fluid">
                        <div class="row counter-parent right-bar-title">
                            <div class="col-5 text-center title-div-left">
                                <span>LOKET</span>
                            </div>
                            <div class="col-7 text-center title-div-right">
                                <span>NO TIKET</span>
                            </div>
                        </div>
                    </div>

                    <div id="content-righ-bar">
                        {{-- INCOMING ANTRIAN --}}
                        <div class="col-md-12 container-fluid">
                            <div class="row counter-parent right-bar-counter">
                                <div class="col-5 text-center right-bar-counter-left">
                                    <div class="parent-right-bar-counter-left">
                                        <h1 class="text-white counter-number" id="history_2_left">
                                            @if (array_key_exists(1, $historyQueues))
                                                {{ $historyQueues[1]->Counter }}
                                            @else
                                                <span class="invisible">-</span>
                                            @endif
                                        </h1>
                                    </div>
                                </div>

                                <div class="col-7 text-center">
                                    <div class="parent-right-bar-counter-right">
                                        <h1 class="text-white right-bar-counter-left counter-number"
                                            id="history_2_right">
                                            @if (array_key_exists(1, $historyQueues))
                                                {{ $historyQueues[1]->SeqNumber }}
                                            @else
                                                <span class="invisible">-</span>
                                            @endif
                                        </h1>
                                    </div>
                                </div>
                            </div>

                            <div class="row counter-parent right-bar-counter">
                                <div class="col-5 text-center right-bar-counter-left">
                                    <div class="parent-right-bar-counter-left">
                                        <h1 class="text-white counter-number" id="history_3_left">
                                            @if (array_key_exists(2, $historyQueues))
                                                {{ $historyQueues[2]->Counter }}
                                            @else
                                                <span class="invisible">-</span>
                                            @endif
                                        </h1>
                                    </div>
                                </div>

                                <div class="col-7 text-center">
                                    <div class="parent-right-bar-counter-right">
                                        <h1 class="text-white right-bar-counter-left counter-number"
                                            id="history_3_right">
                                            @if (array_key_exists(2, $historyQueues))
                                                {{ $historyQueues[2]->SeqNumber }}
                                            @else
                                                <span class="invisible">-</span>
                                            @endif
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 container-fluid" onclick="closeApp()">
                            <div class="row counter-parent">
                                <div class="col-5 text-center right-bar-counter-left " style="align-content: center">
                                    <img src="{{ asset('images/contact_bri.jpg') }}" alt="Logo Call BRI"
                                        class="object-fit-fill logo-call">
                                </div>
                                <div class="col-7 text-end align-middle" style="align-content: center">
                                    <h1 class="timer-left display-time">20:19:33</h1>
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


    @include('shared.footer', ['footer_text' => $footer_text])

    <script>
        var intervalNextQueue = {{ env('INTERVAL_CALL_NEXT_QUEUE', 10000) }};
        var left1 = $("#history_1_left");
        var right1 = $("#history_1_right");
        var left2 = $("#history_2_left");
        var right2 = $("#history_2_right");
        var left3 = $("#history_3_left");
        var right3 = $("#history_3_right");
        var displayTime = document.querySelector(".display-time");
        var firstCorouselIklan = $("div#carouselExampleControlsIklan div#parent-container-video");
        const containerProduct = $("div#carouselExampleControlsProduct");
        var carouselExampleControlsIklan = $('#carouselExampleControlsIklan');
        var carouselExampleControlsProduct = $('#carouselExampleControlsProduct')
        var currencyContainer = document.getElementById('content_currency');
        var productContainer = document.getElementById('content_product');
        var firstCorouselProduct = $('div#carouselExampleControlsProduct div#corousel-parent:first-child');
        var all = $('div#corousel-parent');
        var currencyTable = $('div.table-currency');
        var currencyTableST = currencyTable.scrollTop();

        $(document).ready(function() {
            init_iklan_video(0);
            product_corousel(true);
            showTime();
            updateDate();
            currency_table_auto_scroll();
            setInterval(() => {
                get_next_queue()
            }, intervalNextQueue);
            call_console();
        });

        function closeApp() {
            if (confirm("Yakin untuk keluar dari aplikasi antrian!") == true) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('CloseConsole') }}",
                    data: {},
                    dataType: "json",
                    success: function(data, status, xhr) {
                        if (xhr.status == 200) {
                            // window.open("", '_self').window.close();
                            alert(data.message);
                            // window.open("", "_blank", "");
                            // var customWindow = window.open('', '_blank', '');
                            // customWindow.close();
                            setTimeout(() => {
                                $('body').html('');
                            }, 1000);
                        } else {
                            console.log('gagal menutup aplikasi, Silahkan hubungi administrator anda!');
                        }
                    }
                });
            }
        }

        function call_console() {
            $.ajax({
                type: "GET",
                url: "{{ route('callConsoleApp') }}",
                data: {},
                dataType: "json",
                success: function(data, status, xhr) {
                    if (xhr.status == 200) {
                        console.log(data);
                    } else {
                        console.log('error when calling console please contact your admin');
                    }
                }
            });
        }

        function get_next_queue() {
            $.ajax({
                type: "GET",
                url: "{{ route('GetNextQueueTempCallWeb') }}",
                data: {},
                dataType: "json",
                success: function(data, status, xhr) {
                    if (xhr.status == 200) {
                        if (data.queue === null) {} else {
                            show_next_queue(data.queue);
                        }
                    } else {
                        console.log('error please contact your admin');
                    }
                }
            });
        }

        function show_next_queue(record) {
            function change(elem, value) {
                elem.fadeOut(function() {
                    if (value.trim() == '-') {
                        elem.html("<span class='invisible'>-</span>")
                    } else {
                        elem.html(value);
                    }
                    elem.fadeIn();
                    elem = undefined;
                    value = undefined;
                });
            }
            var textl1 = left1.text();
            var textr1 = right1.text();

            var textl2 = left2.text();
            var textr2 = right2.text();

            change(left1, record.Counter);
            change(right1, record.SeqNumber);

            change(left2, textl1);
            change(right2, textr1);

            change(left3, textl2);
            change(right3, textr2);

            textl1 = undefined;
            textr1 = undefined;
            textl2 = undefined;
            textr2 = undefined;
            record = undefined;
        }

        function init_iklan_video(index = 0, next = false) {
            function play_videos($el) {
                local_video = $el.getElementsByTagName('video');
                local_video[0].play();
                local_video[0].addEventListener('ended', function handler(e) {
                    setTimeout(() => {
                        local_video[0].removeEventListener(e.type, handler);
                        local_video = undefined;
                        init_iklan_video(index + 1, true);
                    }, 3000)
                });
            }

            function play_images($el) {
                setTimeout(() => {
                    init_iklan_video(index + 1, true);
                }, 5000)
            }

            if (next) carouselExampleControlsIklan.carousel('next');
            if (firstCorouselIklan.length === 0) return;
            if (firstCorouselIklan[index] === undefined) return init_iklan_video();

            if (firstCorouselIklan[index].getAttribute('data_type') === 'video') {
                play_videos(firstCorouselIklan[index]);
            } else {
                play_images(firstCorouselIklan[index]);
            }
        }

        function currency_table_auto_scroll() {
            if (currencyContainer === null) return;
            currencyContainerClassList = currencyContainer.className.split(/\s+/);

            function scroolUp() {
                var sb = currencyTable.prop("scrollHeight") - currencyTable.innerHeight();
                currencyTable.animate({
                    scrollTop: currencyTableST < sb / 2 ? sb : 0
                }, {
                    duration: 15000,
                    complete: function() {
                        if (productContainer) {
                            productContainer.classList.remove("invisible");
                            currencyContainer.classList.add("invisible");
                            setTimeout(() => {
                                product_corousel(false);
                            }, 2000);
                        } else {
                            setTimeout(() => {
                                currency_table_auto_scroll()
                            }, 2000);
                        }

                        sb = undefined;
                    }
                });
            }
            if (!currencyContainerClassList.includes('invisible')) {
                var sb = currencyTable.prop("scrollHeight") - currencyTable.innerHeight();
                currencyTable.animate({
                    scrollTop: currencyTableST < sb / 2 ? sb : 0
                }, {
                    duration: 15000,
                    complete: function() {
                        scroolUp()
                        sb = undefined;
                    }
                });
            }

            currencyContainerClassList = undefined;
        }

        // Time
        function showTime() {
            let time = new Date();
            displayTime.innerText = time.toLocaleTimeString("en-US", {
                hour12: false
            });
            // jangan di ubah timeout detikannya
            setTimeout(showTime, 1000);
            time = undefined;
        }

        // Date
        function updateDate() {
            let today = new Date();

            let dayName = today.getDay(),
                dayNum = today.getDate(),
                month = today.getMonth(),
                year = today.getFullYear();

            var months = [
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
            var dayWeek = [
                "Senin",
                "Selasa",
                "Rabu",
                "Kamis",
                "Jum'at",
                "Sabtu",
                "Minggu",
            ];
            // value -> ID of the html element
            var IDCollection = ["day", "daynum", "month", "year"];

            // return value array with number as a index
            var val = [dayWeek[dayName], dayNum, months[month], year];
            document.getElementById('display-date').innerHTML = (val[0] + ", " + val[1] + " " + val[2] + " " + val[3]);
            today = undefined;
            dayName = undefined;
            dayNum = undefined;
            month = undefined;
            year = undefined;
            months = undefined;
            dayWeek = undefined;
            IDCollection = undefined;
            val = undefined;
        }

        function run_next_corousel(ids, current_id) {
            function delayNext(ids, current_id) {
                if (ids[0] === undefined) {
                    if (currencyContainer) {
                        currencyContainer.classList.remove("invisible");
                        productContainer.classList.add("invisible");
                        setTimeout(() => {
                            return currency_table_auto_scroll();
                        }, 2000);
                    } else {
                        setTimeout(() => {
                            return product_corousel(false);
                        }, 2000);
                    }
                }

                setTimeout(() => {
                    carouselExampleControlsProduct.carousel('next');

                    setTimeout(() => {
                        var current_id = ids.shift();
                        run_next_corousel(ids, current_id);
                        current_id = undefined;
                    }, 2000);
                }, 2000);
            }

            var current_scroll_table = $("div#corousel-parent[data_id=" + current_id + "] .table-auto-scroll");
            var st = current_scroll_table.scrollTop();
            var sb = current_scroll_table.prop("scrollHeight") - current_scroll_table.innerHeight();
            current_scroll_table.animate({
                scrollTop: st < sb / 2 ? sb : 0
            }, {
                duration: 15000,
                complete: function() {
                    delayNext(ids, current_id)
                    current_scroll_table = undefined;
                    st = undefined;
                    sb = undefined;
                }
            });
        }

        function product_corousel(with_enabled) {
            if (containerProduct.length) {
                if (with_enabled == true) {
                    firstCorouselProduct.addClass('active');
                }

                var current_id = firstCorouselProduct.attr('data_id');
                var new_map = $.map(all, function(elementOrValue, indexOrKey) {
                    if (elementOrValue.getAttribute('data_id') != current_id) return elementOrValue
                        .getAttribute(
                            'data_id');
                });

                var $el = firstCorouselProduct.children().children().children().children('.table-auto-scroll');

                var st = $el.scrollTop();
                var sb = $el.prop("scrollHeight") - $el.innerHeight();
                $el.animate({
                    scrollTop: st < sb / 2 ? sb : 0
                }, {
                    duration: 15000,
                    complete: function() {
                        run_next_corousel(new_map, current_id)
                        current_id = undefined;
                        new_map = undefined;
                        $el = undefined;
                        st = undefined;
                        sb = undefined;
                    }
                });
            }
        }
    </script>
</body>

</html>
