@extends('layouts.app')


@section('content')
<div class="container">
@foreach($esilans as $esilan)
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
@endforeach

</div>
@endsection
