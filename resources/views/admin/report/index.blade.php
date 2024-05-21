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
                                <h5 class="card-title">Reports</h5>
                            </div>
                        </div>
                    </div>
                    <!-- End Welcome -->

                    <!-- Welcome -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Filter</h5>

                                        <!-- Multi Columns Form -->
                                        <form class="row g-3">
                                            <div class="col-md-3">
                                                <label for="inputCity" class="form-label">Tanggal</label>
                                                <input class="datepicker form-control" type="text" name="datetimes"
                                                    id="dateRange">

                                            </div>

                                            <div class="col-md-2">
                                                <label for="inputState" class="form-label">Tipe Transaksi</label>
                                                <select id="inputState" class="form-select">
                                                    @forelse ($transactionType as $item)
                                                        <option value="{{ $item->TrxCode }}">
                                                            {{ Str::upper($item->TrxName) }}</option>
                                                    @empty
                                                        <option selected>KOSONG</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="inputZip" class="form-label">SLA</label>
                                                <select name="cars" class="form-control" id="cars">
                                                    <option value="volvo">ALL</option>
                                                    <option value="saab">OVER SLA</option>
                                                    <option value="mercedes">ACHIVE SLA</option>
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
                                <table class="table table-hover table-bordered" id="report-admin">
                                    <thead>
                                        <tr>
                                            <th width="8%">Tanggal</th>
                                            <th width="5%">No Antrian</th>
                                            <th width="5%">Unit</th>
                                            <th width="5%">No Counter</th>
                                            <th width="15%">Tipe Antrian</th>
                                            <th width="10%">User</th>
                                            <th width="10%">Jam Antrian Masuk</th>
                                            <th width="10%">Jam Antrian Dipanggil</th>
                                            <th width="10%">Lama Customer Menunggu</th>
                                            <th>Over SLA</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                            <tr>
                                                <td> {{ $transaction->BaseDt ?? '-' }}</td>
                                                <td> {{ $transaction->SeqNumber ?? '-' }}</td>
                                                <td> {{ $transaction->UnitServe ?? '-' }}</td>
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
                                            <tr>
                                                <td colspan="10">No Data Available</td>
                                            </tr>
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
