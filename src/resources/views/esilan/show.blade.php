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

{{-- PAGE == TOURNAMENT --}}
@elseif($page == "tournament")
@section('leftContent')
        <h2>Liste des tournois</h2>

        <div class="tournament-list">
          @foreach($esilan->tournaments as $t)
          <div class="tournament-item">
            <figure>
              <img src="{{ asset($t->fullImgPathOrDefault()) }}">
            </figure>
            <div class="text">
              <h3>{{ $t->name }}<span class="time italic"> de {{ $t->beginDate->formatLocalized('%H:%M') }} - {{ $t->endDate->formatLocalized('%H:%M')  }}</span></h3>
              <p class="small italic">{{ $t->game->name }}</p>

              @guest
              <span class="bottom"><i>Vous devez être connecté pour vous inscrire au tournoi</i></span>
              @else
                @if(Auth::user()->isRegisterToEsilan($esilan->id))
                  @if(Auth::user()->isRegisterToTournament($t->id))
                  <div class="bottom">
                    <p>Vous êtes inscrit à ce tournoi</p>
                    <a class="btn btn-grey">Modifier mon inscription</a>
                  </div>
                  @else
                    @if(Auth::user()->canRegisterToTournament($t->id))
                      <a class="btn btn-grey bottom">S'inscrire</a>
                    @else
                    <span class="bottom"><i>Votre place d'Esilan ne vous permet pas de vous inscrire à ce tournoi.</i></span>
                    @endif {{-- endif canRegisterToTournament --}}
                  @endif {{-- endif isRegisterToTournament --}}
                @endif
              @endguest
            </div>
          </div>
          @endforeach
        </div>
@endsection

@endif