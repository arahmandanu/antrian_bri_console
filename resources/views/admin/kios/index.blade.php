@extends('admin.shared.main')

@section('content')
    <style>
        div.dt-container .dt-paging .dt-paging-button {
            padding: 0.1em 0.1em !important;
        }

        table>thead>tr>th {
            text-align: left !important;
        }

        table>tbody>tr>td {
            text-align: left !important;
        }
    </style>

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Kios</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Welcome -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Reports</h5>
                                <a type="button" class="btn btn-success" href="{{ route('ConsoleCreateKios') }}"><i
                                        class="bx  bx-plus"></i> Tambah Menu
                                    Kios</a>
                                <hr>
                                <table class="table table-hover" id="kios-list">
                                    <thead>
                                        <tr>
                                            <th width="10%">Kode</th>
                                            <th width="10%">Nama Service</th>
                                            <th width="20%">Nama Menu</th>
                                            <th width="20%">SLA</th>
                                            <th width="5%">Ditampilkan?</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($Services as $item)
                                            <tr>
                                                <td>{{ $item->TrxCode }}</td>
                                                <td>{{ $item->UnitService == '01' ? 'Teller' : 'cs' }}</td>
                                                <td>{{ $item->TrxName }}</td>
                                                <td>{{ $item->Tservice }}</td>
                                                <td style="text-align: center">
                                                    @if ($item->displayed == '1')
                                                        <span class='badge bg-success'>yes</span>
                                                    @else
                                                        <span class='badge bg-danger'>no</span>
                                                    @endif
                                                </td>
                                                <td class="align-end text-end">
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic mixed styles example">
                                                        <a type="button" class="btn btn-primary"
                                                            href="{{ route('ConsoleEditKios', $item->TrxCode) }}"><i
                                                                class="bx bxs-pencil"></i> Edit</button>
                                                            @if ($item->displayed == '1')
                                                                <a class="btn btn-warning"
                                                                    href="{{ route('ConsoleToogleKios', [$item->TrxCode, 'hide']) }}">
                                                                    <i class="bx bx-hide"></i> hide </a>
                                                            @else
                                                                <a class="btn btn-danger"
                                                                    href="{{ route('ConsoleToogleKios', [$item->TrxCode, 'show']) }}">
                                                                    <i class="bx bx-hide"></i> show</a>
                                                            @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- End Welcome -->
                </div>
            </div>
            <!-- End Left side columns -->
        </div>
    </section>

    <script>
        jQuery(document).ready(function($) {
            $('#kios-list').DataTable({
                responsive: true,
                "pageLength": 20,
                layout: {
                    topStart: {
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    }
                }
            });
        });
    </script>
@endsection
