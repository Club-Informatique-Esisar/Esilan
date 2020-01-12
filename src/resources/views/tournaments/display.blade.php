@extends('layouts.app')


@section('content')
<div class="container">
@foreach($tournaments as $tournament)
    <article class="product">
        <a href="{{ url("/tournaments/".$tournament->id) }}">
        @if(new DateTime() < new DateTime($tournament->beginDate))
            <div class="ribbon ribbon-new"></div>
        @else
            <div class="ribbon ribbon-end"></div>
        @endif
            {{ HTML::image('upload/'.$tournament->imgName, $tournament->imgName.' logo') }}
            <legend>
                <h3>{{ $tournament->name }}</h3>
                <p>{{ $tournament->beginDate->formatLocalized('%A %d %B %G - %T') }}</p>
            </legend>
        </a>
    </article>
@endforeach

</div>
@endsection
