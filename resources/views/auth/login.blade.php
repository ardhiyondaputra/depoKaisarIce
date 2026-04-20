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
        <h1 class="fw-bold mb-2">Login Sistem</h1>
        <p class="text-muted mb-4">
            Silakan login untuk mengakses sistem manajemen depo.
        </p>

        {{-- CARD LOGIN --}}
        <div class="card shadow border-0 mx-auto"
             style="max-width:420px; border-radius:15px;">

            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- USERNAME --}}
                    <div class="mb-3 text-start">
                        <label class="form-label fw-semibold">Username *</label>
                        <input type="text"
                               name="username"
                               class="form-control rounded-3"
                               placeholder="Masukkan username"
                               required>
                    </div>

                    {{-- PASSWORD DENGAN TOGGLE --}}
                    <div class="mb-4 text-start">
                        <label class="form-label fw-semibold">Password *</label>
                        <div class="input-group">
                            <input type="password"
                                   name="password"
                                   id="pwLogin"
                                   class="form-control border-end-0 rounded-start-3"
                                   placeholder="Masukkan password"
                                   required>
                            <span class="input-group-text border-start-0 rounded-end-3" 
                                  onclick="togglePassword()">
                                <i class="bi bi-eye text-muted" id="icLogin"></i>
                            </span>
                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit"
                            class="btn btn-dark w-100 rounded-pill py-2 fw-bold">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('pwLogin');
    const icon = document.getElementById('icLogin');
    
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