@extends('layouts.app')

@section('content')
  <section id="page-header" style="background: url('{{ url("upload/$esilan->imgName") }}') no-repeat 0 16%; background-size: cover;">
    <div class="bg-hover">
        <div class="container header-content clearfix">
            {{-- <a href="{{ 'upload/'.$esilan->img }}" target="_blank" data-jbox-image="gallery1"> --}}
              {{ HTML::image('upload/'.$esilan->imgName, $esilan->imgName.' logo', array( 'width' => 160, 'height' => 212, 'class' => 'img-fullable' )) }}
            {{-- </a> --}}
            <article>
                <h2>{{ $esilan->name }}</h2>
                <span class="date">Du {{ ucfirst($esilan->beginDate->formatLocalized("%A %e %B %Y")) }} au {{ ucfirst($esilan->endDate->formatLocalized("%A %e %B %Y")) }}</span>
            </article>
        </div>
      </div>
  </section>

  <section id="page-body">
    <div class="container body-content clearfix">

      @yield('menuBar')

      <div class="col-left">
        {{-- Display left column content : LAN | Inscriptions | Tournament --}}
        @yield('leftContent')
      </div>

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

@endsection
