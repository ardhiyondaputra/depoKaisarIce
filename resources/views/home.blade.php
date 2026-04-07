@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Dashboard berhasil login 🎉</h2>

    <p>Username: {{ Auth::user()->username }}</p>
    <p>Role: {{ Auth::user()->role }}</p>
    <p>Status: {{ Auth::user()->status }}</p>

</div>
@endsection