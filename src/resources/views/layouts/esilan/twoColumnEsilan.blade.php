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
              @guest
              <div class="product-info clearfix">
                <p><i>Vous devez être connecté pour réserver cette place =)</i></p>
              </div>
              @else
                @if(Auth::user()->isRegisterToEsilan($esilan->id))
                  @if(Auth::user()->ownTicketType($ticketType->id))
                  <div class="product-info clearfix">
                    <a class="btn btn-blue" href="{{ route('editPlace', ['idEsilan' => $esilan->id, 'ticketTypeName' => $ticketType->name ]) }}">Modifier mon inscription</a>
                  </div>
                  <div class="product-info clearfix">
                    <a href="javascript:void(0);" id="mpopupLink" id="remove-ticket" class="txt-cancel">Annuler l'inscription ?</a>
                    <!-- mPopup box -->
                    <div id="mpopupBox" class="mpopup">
                      <div class="mpopup-content">
                          <div class="mpopup-main">
                              <p>Confirmez vous l'annulation de votre place ?</p>
                              <span id="mpopupClose" class="btn btn-cancel-cancel light-hidden">Argh, non !</span>
                              <a href="{{ route('deletePlace', ['idEsilan' => $esilan->id, 'ticketTypeName' => $ticketType->name ]) }}" id="cancel-remove-ticket" class="btn btn-confirm-cancel light-hidden">Je veux annuler ma place !</a>
                          </div>
                      </div>
                    </div>
                  </div>
                  @endif
                @elseif($ticketType->nbTicketAvailable() <= 0 || new DateTime() > new DateTime($esilan->beginDate))
                <div class="product-info clearfix">
                  <button class="btn-blue disabled">Inscriptions fermées</button>
                </div>
                @else
                <div class="product-info clearfix">
                  <a class="btn btn-blue" href="{{ route('buyPlace', ['idEsilan' => $esilan->id, 'ticketTypeName' => $ticketType->name ]) }}">
                    Réserver cette place !
                  </a>
                </div>
                @endif
              @endguest
            </div>
          </aside>
        @endforeach
      </div>
    </div>
  </section>

@endsection
