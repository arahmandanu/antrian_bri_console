@extends('admin.shared.main')

@section('content')
    <style>
        table#editor>tbody>tr>td {
            padding: 20px;
            font-weight: 500;
        }

        table#editor>tbody>tr>td:nth-child(2) {
            align-content: center;
            text-align: middle;
            font-weight: bolder !important;

            h1 {
                font-size: 5vh !important;
            }

        }
    </style>
    <div class="pagetitle">

        <h1>Dashboard</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Properties</li>
                <li class="breadcrumb-item active">Warna Text</li>
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
                                <h5 class="card-title">
                                    Properties <span>Warna Text</span>
                                </h5>

                                <hr>

                                @include('admin.shared.error_validation')

                                <div class="card">
                                    <div class="card-body">
                                        <table class="table" id="editor">
                                            <thead>
                                                <tr>
                                                    <th width="10%"></th>
                                                    <th width="80%"></th>
                                                    <th width="5%"></th>
                                                    <th width="5%"></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse ($fontColors as $item)
                                                    <tr>
                                                        @if ($item->name == 'unit_name')
                                                            <td>Nama Cabang / Unit</td>
                                                            <td class="text-center align-middle"
                                                                style="background: #023e85">
                                                                <h1
                                                                    style="@if (isset($item->value)) color: {{ $item->value }} !important  @else color: #ffffff @endif">
                                                                    {{ $properties->company_name ?? 'Nama Unit Anda' }}
                                                                </h1>
                                                            </td>
                                                            <td class="text-middle align-middle">
                                                                <input type="color"
                                                                    class="form-control form-control-color align-middle"
                                                                    id="exampleColorInput"
                                                                    @if (isset($item->value)) value="{{ $item->value }}"  @else value="#ffffff" @endif
                                                                    title="Choose your color"
                                                                    onchange='changeColor("{{ $item->name }}", this)'>
                                                            </td>
                                                        @elseif ($item->name == 'current_queue')
                                                            <td>Antrian terkini</td>
                                                            <td class="text-center align-middle"
                                                                style="background: #011e40">
                                                                <h1
                                                                    style="@if (isset($item->value)) color: {{ $item->value }} !important @else color: #ffcd12 @endif">
                                                                    02 A003
                                                                </h1>
                                                            </td>
                                                            <td class="text-middle align-middle">
                                                                <input type="color"
                                                                    class="form-control form-control-color align-middle"
                                                                    id="exampleColorInput"
                                                                    @if (isset($item->value)) value="{{ $item->value }}" @else value="#ffcd12" @endif
                                                                    title="Choose your color"
                                                                    onchange='changeColor("{{ $item->name }}", this)'>
                                                            </td>
                                                        @elseif ($item->name == 'first_log')
                                                            <td>Antrian log pertama</td>
                                                            <td class="text-center align-middle"
                                                                style="background: #011e40">
                                                                <h1
                                                                    style="@if (isset($item->value)) color: {{ $item->value }} !important @else color: #ffffff @endif">
                                                                    02 A002
                                                                </h1>
                                                            </td>
                                                            <td class="text-middle align-middle">
                                                                <input type="color"
                                                                    class="form-control form-control-color align-middle"
                                                                    id="exampleColorInput"
                                                                    @if (isset($item->value)) value="{{ $item->value }}" @else value="#ffffff" @endif
                                                                    title="Choose your color"
                                                                    onchange='changeColor("{{ $item->name }}", this)'>
                                                            </td>
                                                        @elseif ($item->name == 'second_log')
                                                            <td>Antrian log kedua</td>
                                                            <td class="text-center align-middle"
                                                                style="background: #011e40">
                                                                <h1
                                                                    style="@if (isset($item->value)) color: {{ $item->value }} !important @else color: #ffffff @endif">
                                                                    02 A001
                                                                </h1>
                                                            </td>
                                                            <td class="text-middle align-middle">
                                                                <input type="color"
                                                                    class="form-control form-control-color align-middle"
                                                                    id="exampleColorInput"
                                                                    @if (isset($item->value)) value="{{ $item->value }}" @else value="#ffffff" @endif"
                                                                    title="Choose your color"
                                                                    onchange='changeColor("{{ $item->name }}", this)'>
                                                            </td>
                                                        @elseif ($item->name == 'watch')
                                                            <td>Jam</td>
                                                            <td class="text-center align-middle"
                                                                style="background: #023e85">
                                                                <h1
                                                                    style="@if (isset($item->value)) color: {{ $item->value }} !important @else color: #ffff00 @endif">
                                                                    00:00:00
                                                                </h1>
                                                            </td>
                                                            <td class="text-middle align-middle">
                                                                <input type="color"
                                                                    class="form-control form-control-color align-middle"
                                                                    id="exampleColorInput"
                                                                    @if (isset($item->value)) value="{{ $item->value }}" @else value="#ffff00" @endif"
                                                                    title="Choose your color"
                                                                    onchange='changeColor("{{ $item->name }}", this)'>
                                                            </td>
                                                        @endif
                                                        <td class="text-middle align-middle">
                                                            <a type="button" class="btn btn-link"
                                                                href="{{ route('ConsoleResetFontColor', $item->id) }}">reset</a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td rowspan="5"></td>
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
        </div>
    </section>

    <script>
        function changeColor(id, e) {
            if (e.value && id) {
                console.log(id, e.value)

                $.ajax({
                    type: "post",
                    url: "{{ route('ConsoleUpdateFontColor') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "value": e.value
                    },
                    dataType: "json",
                    success: function(response, data, xhr) {
                        console.log(response.status)
                        // responseMessage =
                        if (xhr.status == 201) {
                            location.reload();
                        } else {
                            console.log(response.status);
                        }
                    }
                });
            }
        }
    </script>
@endsection
