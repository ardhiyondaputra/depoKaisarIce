<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        @if(
        !Request::is('login') &&
        !Request::is('register') &&
        !Request::is('recovery-password') &&
        !Request::is('recovery-password/reset') &&
        !Request::is('change-password')
    )
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    @endif
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">
            Login
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">
            Register
        </a>
    </li>
@else
    {{-- <li class="nav-item dropdown">
        <a id="navbarDropdown"
           class="nav-link dropdown-toggle"
           href="#"
           role="button"
           data-bs-toggle="dropdown">

            {{ Auth::user()->username }}
        </a>

        <div class="dropdown-menu dropdown-menu-end">

            <a class="dropdown-item"
               href="{{ route('logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">

                Logout
            </a>

            <form id="logout-form"
                  action="{{ route('logout') }}"
                  method="POST">
                @csrf
            </form>

        </div>
    </li> --}}
@endguest
                    </ul>
                </div>
            </div>
        @if(!Request::is('login'))
</nav>
@endif

        <main class="py-4">
            @yield('content')
        </main>

    </div>
</body>
</html>
