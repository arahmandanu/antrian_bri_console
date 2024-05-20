<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dashboard - Console</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('images/logo_bri_2.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/leaflet/leaflet.js') }}"></script>
    {{-- <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script> --}}
    <link href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" rel="stylesheet" />
</head>

<body>
    <div id="osm-map" style="height: 500px;"></div>

    @include('admin.shared.header')

    @include('admin.shared.left_side_bar')
    <main id="main" class="main">
        @include('flash::message')
        @yield('content')
    </main>
    <!-- End #main -->

    @include('admin.shared.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script>
        $(document).ready(function() {
            // Where you want to render the map.
            var element = document.getElementById('osm-map');

            // Create Leaflet map on map element.
            var map = L.map(element);

            // Add OSM tile layer to the Leaflet map.
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);


            // Target's GPS coordinates.
            data = [
                ['-7.7627747', '110.4142924'],
                ['-7.7613647', '110.4204982'],
                ['-7.7605568', '110.4181808'],
            ]
            $.each(data, function(indexInArray, valueOfElement) {
                var target = L.latLng(valueOfElement[0], valueOfElement[1]);
                // Set map's center to target with zoom 14.
                map.setView(target, 15);
                // Place a marker on the same location.
                L.marker(target).addTo(map).bindPopup(indexInArray + 'A pretty CSS popup.<br> Easily customizable.')
                    .openPopup();
            });

        });
    </script>

    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.js') }}"></script>
</body>

</html>