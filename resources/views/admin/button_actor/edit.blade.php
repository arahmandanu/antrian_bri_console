@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ShowDashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Currency</li>
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
                                <h5 class="card-title">Edit <span>/Tombol</span></h5>
                                <hr>

                                @include('admin.shared.error_validation')

                                <form enctype="multipart/form-data" class="row g-3" method="POST"
                                    action="{{ route('tombol.update', $tombol->id) }}">

                                    @method('PUT')
                                    @csrf

                                    <div class="col-12">
                                        <div class="col-12">
                                            <label for="inputEmail4" class="form-label">Kode Unit</label>

                                            <input type="text" disabled class="form-control" id="inputNanme4"
                                                value="{{ $tombol->codeService->Name }}"
                                                placeholder="Silahkan inputkan nama user">
                                        </div>

                                        <div class="col-12">
                                            <label for="inputNanme4" class="form-label">Nama User</label>
                                            <input type="text" required class="form-control" id="inputNanme4"
                                                value="{{ $tombol->name }}" name="name"
                                                placeholder="Silahkan inputkan nama user">
                                        </div>

                                        <div class="col-12">
                                            <label for="inputNanme4" class="form-label">Kode Tombol User</label>
                                            <input type="text" required class="form-control" id="inputNanme4"
                                                value="{{ $tombol->user_button_code }}" name="user_button_code"
                                                placeholder="Silahkan inputkan nama user">
                                        </div>

                                        <div class="col-12">
                                            <label for="inputEmail4" class="form-label">Nomor Kounter</label>
                                            <select class="form-select" required aria-label="Default select example"
                                                name="counter_number">

                                                <option selected value="">Open this select menu</option>
                                                @forelse ($listCounters as $counter)
                                                    <option value="{{ $counter }}"
                                                        {{ $counter == $tombol->counter_number ? 'selected' : '' }}>
                                                        <b>{{ $counter }}</b>
                                                    </option>
                                                @empty
                                                    <option value="">
                                                        <b>Nomor urut sudah penuh silahkan hapus data yang
                                                            sebelumnya</b>
                                                    </option>
                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="col-12 text-center">
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
