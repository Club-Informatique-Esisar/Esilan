@extends('layouts.showEsilan')

@section('pageTitle')
- {{$esilan->name}}
@endsection
@section('page-body')
  <section id="page-body">
    <div class="container body-content clearfix">
      <div class="col-left">
        <h2>Description</h2>
        <article class="clearfix">
          <div class="post-content">
            {!! $esilan->desc !!}
          </div>
        </article>
      </div>


      <div class="col-right">
        @foreach ($esilan->ticketTypes()->orderBy('id')->get() as $ticketType)
          <aside class="clearfix">
            <div class="post-content">
              <div class="product-info clearfix">
                <p class="product-name">{{ $ticketType->name }}</p>
                <p class="product-description">{{ $ticketType->desc }}</p>
              </div>
              <div class="product-info clearfix">
                  <div class="product-price">{{$ticketType->price}}€</div>
                      <div class="product-buy-bar">
                        <span class="product-buy-progess" style="width:{{ $ticketType->salePercentage() }}%"></span>
                      </div>
                  <div class="product-tickets">{{ $ticketType->nbSales() }} inscrits / {{ $ticketType->maxTicket }}</div>
              </div>
              <div class="product-info clearfix">
              @guest
              <p><i>Vous devez être connecté pour réserver cette place =)</i></p>
              @else
                @if(Auth::user()->isAlreadyRegisterToEsilan($esilan->id))
                  <button class="disabled">Déjà inscrit</button>
                @elseif($ticketType->nbTicketAvailable() <= 0 || new DateTime() > new DateTime($esilan->beginDate))
                  <button class="disabled">Inscriptions fermées</button>
                @else
                  <a class="btn" href="{{ route('buyPlace', ['idEsilan' => $esilan->id, 'ticketTypeName' => $ticketType->name ]) }}" class="button-reservation">
                    Réserver cette place !
                  </a>
                @endif
              @endguest
              </div>
            </div>
          </aside>
        @endforeach

        {{-- <aside class="clearfix">
          <h2>Liste des inscrits</h2>
          <div class="post-content">
            <p>{{ $esilan->nbPlacesSales() }} inscrits au total</p>
            <div class="post-avatar">
              @foreach()
              <a href="{{ url('#') }}">
                <img src="{{ asset("/upload/profil") }}" alt="ZeZombini" class="istooltip" data-toggle="tooltip" data-placement="top">
              </a>
              @endforeach
            </div>
          </div>
        </aside> --}}
      </div>
    </div>

  </section>
@endsection
