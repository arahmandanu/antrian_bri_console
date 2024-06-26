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
                <li class="breadcrumb-item active">Report</li>
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
                                <h5 class="card-title">Reports <span>/ Antrian</span></h5>
                            </div>
                        </div>
                    </div>
                    <!-- End Welcome -->

                    <!-- Welcome -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-1">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Filter</h5>

                                        <!-- Multi Columns Form -->
                                        <form class="row g-3" method="GET" action="{{ route('ConsoleIndexReport') }}">
                                            @csrf
                                            <div class="col-md-3">
                                                <label for="inputCity" class="form-label">Tanggal (MM/DD/YYYY)</label>
                                                <input class="datepicker form-control" type="text" name="datetimes"
                                                    id="dateRange" value="{{ old('datetimes') }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="inputState" class="form-label">Tipe Transaksi</label>
                                                <select id="inputState" class="form-select" name="trx_param">
                                                    <option></option>
                                                    @forelse ($transactionType as $item)
                                                        <option value="{{ $item->TrxCode }}"
                                                            @if (old('trx_param') == $item->TrxCode) selected @endif>
                                                            {{ $item->codeService->Name . ' | ' . Str::upper($item->TrxName) }}
                                                        </option>
                                                    @empty
                                                        <option selected>KOSONG</option>
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="inputZip" class="form-label">SLA</label>
                                                <select name="type_sla" class="form-control" id="type_sla">
                                                    <option></option>
                                                    <option value="over"
                                                        @if (old('type_sla') == 'over') selected @endif>OVER SLA</option>
                                                    <option value="achive"
                                                        @if (old('type_sla') == 'achive') selected @endif>ACHIVE SLA
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 text-center" style="align-self: flex-end;">
                                                <button type="submit" class="btn btn-primary"> <i class="bx bx-search"></i>
                                                    Cari</button>
                                            </div>
                                        </form>
                                        <!-- End Multi Columns Form -->
                                    </div>
                                </div>

                                <hr>

                                <div class="card">
                                    <table class="table table-hover table-striped" id="report-admin"
                                        style="overflow-x: auto !important">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>No Antrian</th>
                                                <th>Unit</th>
                                                <th>Konter</th>
                                                <th>Tipe Antrian</th>
                                                <th>User</th>
                                                <th>Antrian Masuk</th>
                                                <th>Antrian Dipanggil</th>
                                                <th>Lama Customer Menunggu</th>
                                                <th>SLA</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse ($transactions as $transaction)
                                                <tr>
                                                    <td> {{ $transaction->BaseDt ?? '-' }}</td>
                                                    <td> {{ $transaction->SeqNumber ?? '-' }}</td>
                                                    <td> {{ $transaction->unit_service_name ?? '-' }}</td>
                                                    <td> {{ $transaction->CounterNo ?? '-' }}</td>
                                                    <td> {{ $transaction->TrxName ?? '-' }}</td>
                                                    <td> {{ $transaction->UserId ?? '-' }}</td>
                                                    <td> {{ $transaction->TimeTicket ?? '-' }}</td>
                                                    <td> {{ $transaction->TimeCall ?? '-' }}</td>
                                                    <td> {{ $transaction->CustWaitDuration ?? '-' }}</td>
                                                    <td>
                                                        <?php
                                                        $data = $transaction->TOverSLA ?? '00:00:00';
                                                        if ($data == '00:00:00') {
                                                            echo "<span class='badge bg-success'>$data</span>";
                                                        } else {
                                                            echo "<span class='badge bg-danger'>$data</span>";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
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
            $('input#dateRange').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                },
            });

            $('input#dateRange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                    'MM/DD/YYYY'));
            });

            $('input#dateRange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });


            $('#report-admin').DataTable({
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
