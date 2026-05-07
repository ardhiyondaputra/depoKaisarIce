@extends('layouts.app')

@section('title', 'Laporan Operasional')

@section('content')

<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">

    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4"
     style="margin-left: 16.666667%;">

            @include('layouts.topbar')

            <div class="card border-0 shadow-sm rounded-4 mt-4">

                <div class="card-header bg-white border-0 p-4">

                    <h4 class="fw-bold mb-0">
                        Laporan Operasional
                    </h4>

                </div>

                <div class="card-body p-4">

                    <form action="{{ route('laporan.cetak') }}"
                          method="GET">

                        <div class="row">

                            <div class="col-md-5 mb-3">

                                <label class="form-label fw-semibold small text-muted">
                                    TANGGAL AWAL
                                </label>

                                <input type="date"
                                       name="tanggal_awal"
                                       class="form-control rounded-3"
                                       required>

                            </div>

                            <div class="col-md-5 mb-3">

                                <label class="form-label fw-semibold small text-muted">
                                    TANGGAL AKHIR
                                </label>

                                <input type="date"
                                       name="tanggal_akhir"
                                       class="form-control rounded-3"
                                       required>

                            </div>

                            <div class="col-md-2 d-flex align-items-end mb-3">

                                <button type="submit"
                                        class="btn btn-dark w-100 rounded-pill">

                                    Cetak PDF

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
