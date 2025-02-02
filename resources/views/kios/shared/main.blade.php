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
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">

    <link href="{{ asset('css/kios.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my-font.css') }}" rel="stylesheet">
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
                                        <img onclick="reloadPage()" src="{{ asset('images/logo_white.png') }}"
                                            class="object-fit-contain" alt="Logo BRI"
                                            style="max-width: 100%;
                                                max-height: 100%;">
                                        <h2 class="text-white"> {{ $companyName }} </h2>
                                        <h2 class="text-white" style="font-family: kapakana;">
                                            Melayani
                                            Dengan
                                            Sepenuh Hati</h2>
                                        <hr style="color: #faa901; opacity: 100 !important">
                                        <h3 class="text-white">Silahkan Ambil Antrian</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="h-100 scrollbar2"
                                style="padding-left: 20px !important; padding-right: 20px !important ; padding-bottom: 30px !important; height: 50vh !important; overflow: auto;"
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
                @if ($footerTexts->count() == 0)
                    <h1 class="text-white walking-text invisible display-1"
                        style="white-space: nowrap; float: left;  @if (isset($fotrColor)) color: {{ $fotrColor }} !important @endif">
                        -</h1>
                @else
                    <h1 id="animate_footer" class="text-white walking-text- display-1"
                        style="white-space: nowrap; float: left;  @if (isset($fotrColor)) color: {{ $fotrColor }} !important @endif"
                        flow='{{ $footer_flow }}'></h1>
                @endif
            </div>
        </footer>
    </div>

    <div class="modal fade" id="verticalycentered" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Silahkan Scan Barcode Anda!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" id="modal_scan_barcode"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Vertically centered Modal-->

    <!-- Modal -->
    <div class="modal fade" id="ticketModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const listTextFooter = {!! json_encode($footerTexts) !!};

        $(document).ready(function() {
            getMainMenu();
            animate();

            document.getElementById('verticalycentered').addEventListener('shown.bs.modal', function() {
                $('div#modal_scan_barcode').html(
                    '<input class="form-control" type="text" name="scan" id="scan" onchange="getBarcodeQueue(this)">'
                );
                $('input#scan').focus();

            })

            document.getElementById('verticalycentered').addEventListener('hidden.bs.modal', function(event) {
                $('div#modal_scan_barcode').html('');
            })
        });

        function reloadPage() {
            location.reload();
        }

        function getBarcodeQueue(e) {
            $.ajax({
                type: "GET",
                url: "{{ route('DashboardKiosPrintOnlineQueue') }}" + '?data=' + e.value,
                dataType: "json",
                success: function(data, textStatus, xhr) {
                    if (xhr.status == 201) {
                        $('#verticalycentered').modal('hide');
                    }
                },
                complete: function(data) {
                    $('input#scan').val()
                    if (data.status == 422) {
                        $('div#modal_scan_barcode').html("<span>" + data.responseJSON.message +
                            "</span>")
                    }
                }
            });
        }

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

        function alertDevice(message) {
            Swal.fire({
                title: "Device is ready?",
                text: message,
                icon: "question"
            });
        }

        function animate(index = 0) {
            var element = document.getElementById('animate_footer');

            if (element === null) return;
            const flow = element.getAttribute("flow");
            if (listTextFooter.length == 0) return;
            if (listTextFooter[index] === undefined) return animate();

            $('h1#animate_footer').text(listTextFooter[index].text.toUpperCase());
            let elementWidth = element.offsetWidth;
            let parentWidth = element.parentElement.offsetWidth;

            if (flow === 'right') {
                let flag = -elementWidth;
                setInterval(() => {
                    element.style.marginLeft = ++flag + "px";
                    if (parentWidth == flag) {

                        index = index + 1;
                        if (listTextFooter[index] === undefined) {
                            index = 0;
                        }
                        $('h1#animate_footer').text(listTextFooter[index].text);
                        flag = -elementWidth;
                    }
                }, 10);
            } else {
                let flag = parentWidth;
                setInterval(() => {
                    element.style.marginLeft = --flag + "px";
                    if (flag === (0 - elementWidth)) {
                        index = index + 1;
                        if (listTextFooter[index] === undefined) {
                            index = 0;
                        }

                        $('h1#animate_footer').text(listTextFooter[index].text);
                        flag = parentWidth;
                    }
                }, 10);
            }

        }

        function loadTicketPopup(ticket_id = null, base_date = null) {
            if (ticket_id === null || base_date === null) {
                return
            }
            console.log(window.location.href);
            window.location.href = "kios/show_ticket/" + base_date + "/" + ticket_id;
        }
    </script>
</body>

</html>
