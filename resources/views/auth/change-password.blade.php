@extends('layouts.app')

@section('content')
<style>
    input::-ms-reveal,
    input::-ms-clear {
        display: none;
    }

    .input-group-text {
        background-color: white;
        border-left: none;
        cursor: pointer;
    }

    .form-control:focus + .input-group-text {
        border-color: #86b7fe;
    }
</style>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="text-center w-100">

        {{-- LOGO --}}
        <img src="{{ asset('images/LOGO DEPO KAISAR ICE.svg') }}"
             style="width:110px"
             class="mb-3">

        {{-- TITLE --}}
        <h5 class="fw-semibold">Depo Kaisar Ice</h5>
        <h1 class="fw-bold mb-2">Ganti Password</h1>
        <p class="text-muted mb-4">
            Silakan ubah password untuk menjaga keamanan akun Anda.
        </p>

        {{-- CARD --}}
        <div class="card shadow border-0 mx-auto"
             style="max-width:420px; border-radius:15px;">

            <div class="card-body p-4">

                <form method="POST" action="{{ route('password.change.update') }}">
                    @csrf

                    {{-- PASSWORD LAMA --}}
                    <div class="mb-3 text-start">
                        <label class="form-label fw-semibold">Password Lama *</label>
                        <input type="password"
                               name="password_lama"
                               class="form-control rounded-3"
                               placeholder="Masukkan password lama"
                               required>
                    </div>

                    {{-- PASSWORD BARU --}}
                    <div class="mb-3 text-start">
                        <label class="form-label fw-semibold">Password Baru *</label>
                        <div class="input-group">
                            <input type="password"
                                   id="pwBaru"
                                   name="password_baru"
                                   class="form-control border-end-0 rounded-start-3"
                                   placeholder="Masukkan password baru"
                                   required>
                            <span class="input-group-text border-start-0 rounded-end-3"
                                  onclick="togglePassword('pwBaru','icBaru')">
                                <i class="bi bi-eye text-muted" id="icBaru"></i>
                            </span>
                        </div>
                    </div>

                    {{-- KONFIRMASI PASSWORD --}}
                    <div class="mb-4 text-start">
                        <label class="form-label fw-semibold">Konfirmasi Password Baru *</label>
                        <div class="input-group">
                            <input type="password"
                                   id="pwKonfirmasi"
                                   name="password_baru_confirmation"
                                   class="form-control border-end-0 rounded-start-3"
                                   placeholder="Ulangi password baru"
                                   required>
                            <span class="input-group-text border-start-0 rounded-end-3"
                                  onclick="togglePassword('pwKonfirmasi','icKonfirmasi')">
                                <i class="bi bi-eye text-muted" id="icKonfirmasi"></i>
                            </span>
                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <button class="btn btn-dark w-100 rounded-pill py-2 fw-bold">
                        Simpan Password Baru
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        input.type = "password";
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}
</script>
@endsection