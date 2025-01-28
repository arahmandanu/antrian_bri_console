<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BRI - Ticket</title>
    <link rel="stylesheet" href="{{ asset('css/ticket-style.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    <div class="container">

        <div class="ticket airline">
            <div class="top">
                <div>
                    <img class="my_log_ticket" src="{{ asset('images/bri_logo_blue.png') }}" alt="">
                </div>
                <div class="ticket-bank-name">
                    <p style='font-family: "Nunito", sans-serif;'>{{ $properties->company_name }}</p>
                </div>

            </div>

            <div class="bottom">
                @if ($ticket)
                    <div class="column">
                        <div class="row-1">
                            <span class="top-ticket" style="letter-spacing: -1px;font-weight: 500;">Nomor Layanan</span>
                            <h1 style="font-size: 60px;">{{ $ticket->SeqNumber }}</h1>
                        </div>
                        <div class="row-2">
                            <p>
                                <span>Tanggal Antrian:</span>
                                {{ $ticket->created_at->isoFormat('DD-MM-YYYY') }}
                            </p>
                        </div>

                        <div class="row-3" style="text-align: center">
                            <button onclick="cetakAntrian({{ $ticket->SeqDt }}, {{ $ticket->BaseDt }})" type="button"
                                class="btn btn-link">Cetak Antrian</button>
                        </div>
                    </div>
                @else
                    <div class="column">
                        <div class="row-1">
                        </div>
                        <div class="row-2">
                            <p>
                                Kode antrian tidak bisa di gunakan!
                            </p>
                            <p>
                                Silahkan buat antrian baru
                            </p>
                        </div>
                    </div>
                @endif


            </div>

            <div class="footer">
                <div class="bar--code"></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            setTimeout(
                function() {
                    console.log(window.location.hostname);

                    window.location.href = "{{ route('DashboardKios') }}";
                }, 10000);
        });

        function cetakAntrian(id, base_date) {
            $.get("{{ route('DashboardManualPrintTicket') }}", {
                    base_date: base_date,
                    id: id
                },
                function(data, textStatus, jqXHR) {

                },
                "json"
            );
        }
    </script>
</body>

</html>
