@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Product</li>
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
                                <h5 class="card-title">Detail <span>/Product</span></h5>
                                <hr>

                                @include('admin.shared.error_validation')

                                <form class="row g-3" method="POST" action="{{ route('ConsoleStoreProduct') }}">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label">Nama Product</label>
                                        <input type="text" required class="form-control" id="inputNanme4" name="name"
                                            placeholder="Silahkan inputkan nama product" value="{{ $masterProduct->name }}">
                                    </div>

                                    <div class="col-12">
                                        <label for="inputEmail4" class="form-label">Urutan Tampilan</label>
                                        <select class="form-select" required aria-label="Default select example"
                                            name="display_number">
                                            <option selected value="">Open this select menu</option>
                                            @forelse ($displayNumbers as $displayNumber)
                                                <option value="{{ $displayNumber }}"
                                                    {{ $masterProduct->display_number == $displayNumber ? 'selected' : '' }}>
                                                    <b>{{ $displayNumber }}</b>
                                                </option>
                                            @empty
                                                <option value="0">
                                                    <b>Nomor urut sudah penuh silahkan hapus data yang
                                                        sebelumnya</b>
                                                </option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">Ditampilkan?</legend>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="show"
                                                        id="show1" value="1"
                                                        {{ $masterProduct->show == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="show1">
                                                        Show
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="show"
                                                        id="show2" value="0"
                                                        {{ $masterProduct->show == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="show2">
                                                        hide
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
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
