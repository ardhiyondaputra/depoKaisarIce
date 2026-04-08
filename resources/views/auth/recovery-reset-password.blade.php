@extends('layouts.app')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">

    <div class="card shadow" style="max-width:450px; width:100%">

        <div class="card-body">

            <h4 class="mb-4 text-center">
                Reset Password Baru
            </h4>

            <form method="POST"
                  action="{{ route('password.recovery.reset') }}">

                @csrf


                {{-- PASSWORD BARU --}}
                <div class="mb-3">
                    <label>Password Baru</label>

                    <input type="password"
                           name="password_baru"
                           class="form-control"
                           required>
                </div>


                {{-- KONFIRMASI PASSWORD --}}
                <div class="mb-3">
                    <label>Konfirmasi Password</label>

                    <input type="password"
                           name="password_baru_confirmation"
                           class="form-control"
                           required>
                </div>


                <button class="btn btn-dark w-100">

                    Reset Password

                </button>

            </form>

        </div>

    </div>

</div>

@endsection