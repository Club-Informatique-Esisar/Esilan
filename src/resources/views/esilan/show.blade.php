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


{{-- PAGE == HOME --}}
@if($page == "home")
@section('leftContent')
        <h2>Description</h2>
        <article class="clearfix">
          <div class="post-content">
            {!! $esilan->desc !!}
          </div>
        </article>
@endsection


{{-- PAGE == REGISTER --}}
@elseif($page == "register")
@section('leftContent')
        <h2>Liste des inscrits</h2>

        @foreach($esilan->ticketTypes as $tt)
        <h3>{{ $tt->name }} - <span class="small">{{ $tt->nbSales() }} places vendus sur {{ $tt->maxTicket }}</span></h3>

        <div class="gamer-list" comment="grid">
          {{-- Glue @for to <article> to get ride of blank space due to "inline-block" css rules --}}
          @foreach ($tt->tickets as $t)<article class="gamer-item">
            <a href="#">
              <img src="{{ asset('img/pattern.png') }}" alt="pseudal" />
              <legend>
                <h4>{{ $t->gamer->name }}</h4>
                {{-- <p></p> --}}
              </legend>
            </a>
          </article>@endforeach
        </div>
        @endforeach
@endsection
@endif