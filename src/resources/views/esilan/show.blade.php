@extends('layouts.esilan.twoColumnEsilan')

@section('pageTitle')
- {{$esilan->name}}
@endsection


{{-- Navigation bar --}}
@section('menuBar')
        <ul>
            @if($page == "home")
            <li class="active"><a href="?page=home">Accueil</a></li>
            @else
            <li><a href="?page=home">Accueil</a></li>
            @endif

            @if($page == "register")
            <li class="active"><a href="?page=register">Inscription</a></li>
            @else
            <li><a href="?page=register">Inscription</a></li>
            @endif

            @if($page == "tournament")
            <li class="active"><a href="?page=tournament">Tournois</a></li>
            @else
            <li><a href="?page=tournament">Tournois</a></li>
            @endif
        </ul>
@endsection


@section('leftContent')
        <h2>Description</h2>
        <article class="clearfix">
          <div class="post-content">
            {!! $esilan->desc !!}
          </div>
        </article>
@endsection
