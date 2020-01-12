<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Esilan @yield('pageTitle')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="https://fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/esilan.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header>
            <div class="container clearfix">
                <h1>
                    <a href="{{ url('/') }}">
                        {{ HTML::image('img/logo_esilan.png', 'logo esilan')}}
                        {{-- <img src="" width="auto" height="32px"> --}}
                    </a>
                </h1>

                <ul class="nav">
                    <li class="hardcore-gamer"><a href="{{ url('/') }}">Accueil</a></li>
                    <li class="hardcore-gamer "><a href="{{ url("/esilan") }}">L'Esilan</a></li>
                    <li class="hardcore-gamer "><a href="{{ url("/tournaments") }}">Tournois</a></li>
                    <li class="hardcore-gamer "><a href="{{ url("/faq") }}">F.A.Q.</a></li>
                </ul>

                @guest
                <ol class="nav">
                    <li>
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                </ol>
                @else
                <ol class="nav">
                @if(Auth::user()->hasRole("administrator"))
                    <li>
                        <a href="{{route('admin')}}" class="bold red">Panel Admin</a>
                    </li>
                @endif
                    <li>
                        <a href="{{ route('profile') }}">{{ Auth::user()->name }}</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                        </form>
                    </li>
                </ol>
                @endguest
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>
    <div id="gallery" class="gallery">
        <span id="closeButton">&times;</span>
        <img class="gallery-content" id="img-gallery">
    </div>
</body>
<footer>
    <div class="container clearfix">
        <p>
            © Esilan 2019 – Version 3.0 – 
            <a href="mailto:club.informatique@esisar.grenoble-inp.fr">club.informatique@esisar.grenoble-inp.fr</a> 
            {{-- – <a href="https://esilan.esisariens.org/contact/">Contact</a> --}}
            <br> 
            All rights reserved &lt;3
        </p>
    </div>
</footer>
</html>
