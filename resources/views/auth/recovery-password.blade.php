@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:450px">

        <div class="card-body">

            <h4 class="mb-4">Recovery Password</h4>

            <form method="POST"
                  action="{{ route('password.recovery.check') }}">

                @csrf


                <div class="mb-3">
                    <label>Username</label>

                    <input type="text"
                           name="username"
                           class="form-control"
                           required>
                </div>


                <div class="mb-3">
                    <label>Recovery Key</label>

                    <input type="text"
                           name="recovery_key"
                           class="form-control"
                           required>
                </div>


                <button class="btn btn-dark w-100">

                    Verifikasi

                </button>

            </form>

        </div>

    </div>

</div>

@endsection