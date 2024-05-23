@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Kios</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Edit <span>/Kios</span></h5>
                                <hr>

                                @include('admin.shared.error_validation')

                                <form enctype="multipart/form-data" class="row g-3" method="POST"
                                    action="{{ route('ConsoleStoreKios') }}">
                                    @csrf

                                    <div class="col-12">
                                        <div class="col-12">
                                            <label for="inputNanme4" class="form-label">Kode (4 digit char)</label>
                                            <input type="text" required class="form-control" id="inputNanme4"
                                                min="4" max="4" name="TrxCode" required
                                                placeholder="Silahkan inputkan kode min 4 max 4">
                                        </div>

                                        <div class="col-12">
                                            <label for="inputNanme4" class="form-label">Nama Menu</label>
                                            <input type="text" required class="form-control" id="inputNanme4"
                                                name="TrxName" value="" placeholder="Silahkan inputkan nama menu">
                                        </div>

                                        <div class="col-12">
                                            <label for="inputNanme4" class="form-label">Nama Unit</label>
                                            <select name="UnitService" class="form-select" required>
                                                <option value="01">Teller</option>
                                                <option value="02">CS</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="inputNanme4" class="form-label">SLA service</label>
                                            <select name="Tservice" class="form-select" required>
                                                @for ($i = 1; $i < 60; $i++)
                                                    <option value="{{ $i }}"> {{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                        </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
