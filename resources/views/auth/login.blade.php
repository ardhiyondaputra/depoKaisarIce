@extends('layouts.app')

@section('content')

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
                        <label class="form-label fw-semibold">
                            Username *
                        </label>

                        <input type="text"
                               name="username"
                               class="form-control"
                               required>
                    </div>


                    {{-- PASSWORD --}}
                    <div class="mb-3 text-start">
                        <label class="form-label fw-semibold">
                            Password *
                        </label>

                        <input type="password"
                               name="password"
                               class="form-control"
                               required>
                    </div>


                    <div class="d-flex justify-content-between mb-3">

                        <a href="{{ route('password.recovery.form') }}">
                            Lupa Password?
                        </a>

                    </div>


                    {{-- BUTTON --}}
                    <button type="submit"
                            class="btn btn-dark w-100 rounded-pill">
                        Login
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection