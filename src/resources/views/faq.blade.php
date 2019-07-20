@extends('layouts.app')

@section('content')
<section id="home-content">
    <div class="container">
        <article>
            <div class="faq-container">
                {!! $faq->desc !!}
            </div>
        </article>
    </div>
</section>
@endsection