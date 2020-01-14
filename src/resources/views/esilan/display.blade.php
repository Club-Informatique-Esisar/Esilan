@extends('layouts.app')


@section('content')
<div class="container">
    <section id="display-esilan">
        <div class="esilan-list">

        @foreach($esilans as $e)
            @if($e->beginDate->greaterThan(now()))
            <div class="esilan-item" onclick="location.href ='{{ url('/esilan/'.$e->id) }}'">
            @else 
            <div class="esilan-item inactive" onclick="location.href ='{{ url('/esilan/'.$e->id) }}'">>
            @endif
                <figure class="m0">
                    <img src="{{ asset($e->fullImgPathOrDefault("m")) }}">
                </figure>
                    
                <div class="right">
                    <div class="top">
                        <a href="{{ url('/esilan/'.$e->id) }}">
                            <div class="text">
                                <h2>{{ $e->name }}</h2>
                                <p class="italic">{{ $e->beginDate->formatLocalized("%A %e %B %H") }}h -  {{ $e->endDate->formatLocalized("%A %e %B %H") }}h</p>
                            </div>
                        </a>
                        <div>
                            @foreach($e->ticketTypes as $tt)
                            <p>{{ $tt->name }} - {{ $tt->price }}€</p>
                            @endforeach
                        </div>
                    </div>
                    @if($e->tournaments->count() > 0)
                    <div class="tournament-list">
                        <a class="clickable-tournament" href="{{ url('/esilan/'.$e->id.'?page=tournament') }}">
                            <div>
                            @foreach($e->tournaments as $t)
                                <figure>
                                    <img src="{{ asset($t->fullImgPathOrDefault("s")) }}">
                                </figure>
                            @endforeach
                            </div>
                            <div class="overlay">
                                <p>Voir les tournois</p>
                            </div>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
        </div>
    </section>
</div>
{{-- @foreach($esilans as $esilan)
    <article class="product">
        <a href="{{ url("/esilan/".$esilan->id) }}">
        @if(new DateTime() < new DateTime($esilan->beginDate))
            <div class="ribbon ribbon-new"></div>
        @else
            <div class="ribbon ribbon-end"></div>
        @endif
            {{ HTML::image('upload/'.$esilan->imgName, $esilan->imgName.' logo') }}
            <legend>
                <h3>{{ $esilan->name }}</h3>
                <p>{{ $esilan->beginDate->formatLocalized('%A %d %B %G - %T') }}</p>
            </legend>
        </a>
    </article>
@endforeach --}}

@endsection
