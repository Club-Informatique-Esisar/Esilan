@extends('layouts.showEsilan')

@section('pageTitle')
- {{$esilan->name}}
@endsection

@section('leftContent')
        <h2>Description</h2>
        <article class="clearfix">
          <div class="post-content">
            {!! $esilan->desc !!}
          </div>
        </article>
@endsection
