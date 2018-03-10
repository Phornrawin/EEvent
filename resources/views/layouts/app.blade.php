<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EEvent</title>
    <!-- Styles -->
    <script src="https://use.fontawesome.com/ebc57c5fe2.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="padding-top: 100px">
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'EEvent') }}
            </a>

            {{--This is for resposive menu dropdown--}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li><a class="nav-link" href="{{ route('events.index') }}">Events</a></li>
                    <li><a class="nav-link" href="{{ route('events.index') }}">Category</a></li>
                    <li><a class="nav-link" href="/">About us</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">Sign in</a></li>
                        <li><a class="nav-link text-danger" href="{{ route('register') }}">Sign Up</a></li>
                    @else
                        <li><a class="nav-link" href="{{ route('profile.show') }}">Profile</a></li>
                        <li><a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
