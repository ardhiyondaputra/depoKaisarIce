@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3" style="background-color: #f8f9fc; min-height: 100vh;">
    <div class="row">
        @include('layouts.sidebar')

        <div class="col-md-9 col-lg-10 ps-md-4">
            @include('layouts.topbar')

            <div class="row">
                <div class="col-md-7 col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                        <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fw-bold mb-0">Pengaturan Profil</h5>
                                <p class="text-muted small mb-0 mt-1">Kelola informasi akun Anda sebagai <strong>{{ ucfirst(Auth::user()->role) }}</strong></p>
                            </div>
                            <span class="badge rounded-pill bg-dark px-3 py-2">
                                <i class="bi bi-shield-check me-1"></i> {{ strtoupper(Auth::user()->role) }}
                            </span>
                        </div>
                        
                        <div class="card-body p-4 pt-0">
                            <form action="{{ route('profil.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Username</label>
                                    <input type="text" name="username" 
                                        class="form-control rounded-3 border-light bg-light @error('username') is-invalid @enderror" 
                                        value="{{ old('username', Auth::user()->username ?? Auth::user()->name) }}">
                                    
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Role / Hak Akses</label>
                                    <input type="text" class="form-control rounded-3 border-light bg-light" value="{{ strtoupper(Auth::user()->role) }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Status Akun</label>
                                    <div class="d-flex align-items-center ps-1">
                                        <span class="fw-bold small text-success">
                                            <i class="bi bi-circle-fill me-2" style="font-size: 8px;"></i>{{ ucfirst(Auth::user()->status ?? 'Aktif') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <hr class="my-4 text-muted opacity-25">
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-dark rounded-pill py-2 fw-bold shadow-sm">
                                        <i class="bi bi-check2-circle me-1"></i> Perbarui Data Profil
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-3 bg-white">
                        <div class="d-flex align-items-center">
                            <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="bi bi-person-badge fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-bold mb-0">Informasi Login</h6>
                                <small class="text-muted">Terakhir login: {{ date('d M Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection