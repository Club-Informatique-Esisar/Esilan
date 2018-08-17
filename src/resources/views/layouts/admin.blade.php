<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Esilan - Panel Admin @yield('pageTitle')</title>

    <!-- Scripts -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" defer></script>
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/b-1.5.2/b-html5-1.5.2/datatables.min.js" defer></script> --}}
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}" defer></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}" defer></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
						

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/datatables.min.css"/>

</head>
<body>
    <header>
        <div class="logo">
            <a href="{{ url('/admin') }}">
                EsiDashboard
            </a>
        </div>
        <ul class="nav-top">
            <li><a href="{{url('/')}}">Retour au site</a></li>
        </ul>
    </header>

    <div class="admin-body">
        <aside class="sidebar">
            <div>
                <ul class="nav">
                    <li><a href="{{ url('/admin/esilan')}}">Esilans</a></li>
                    <li><a href="{{ url('/admin/sales')}}">Ventes</a></li>
                    <li><a href="{{ url('/admin/games')}}">Jeu</a></li>
                    <li><a href="{{ url('/admin/tournaments')}}">Tournois</a></li>
                    <li><a href="{{ url('/admin/gamers')}}">TODO - Gamers</a></li>
                </ul>
            </div>
        </aside>

        <main>
            @yield('content')
        </main>
    </div>

    <div id="gallery" class="gallery">
        <span id="closeButton">&times;</span>
        <img class="gallery-content" id="img-gallery">
    </div>
</body>
</html>
