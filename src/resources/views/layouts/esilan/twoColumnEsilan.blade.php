@extends('layouts.esilan.globalEsilan')

@section('pageBody')
  <section id="page-body">

    {{-- Nav bar --}}
    <nav class="menu-nav">
      <div class="container nav-content clearfix">
        @yield('menuBar')
      </div>
    </nav>


    <div class="container body-content clearfix">

      {{-- Left content --}}
      <div class="col-left">
        {{-- Display left column content : LAN | Inscriptions | Tournament --}}
        @yield('leftContent')
      </div>

      {{-- Right content with ticket type  --}}
      <div class="col-right">
        {{-- Displaying all tickets --}}
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
      </div>
    </div>
  </section>

@endsection
