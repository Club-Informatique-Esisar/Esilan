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
  @yield('pageBody')
@endsection
