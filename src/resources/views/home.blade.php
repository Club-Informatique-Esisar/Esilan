@extends('layouts.app')

@section('content')
<section id="home-content">
    <div class="container">
    @if($esilan)
        <article>
            <div class="poster-container">
                <a href="{{ url("/esilan/$esilan->id")}}">
                    <div class="poster-overlay">
                        @if(new DateTime() < new DateTime($esilan->beginDate))
                            <div class="esilan-detail green-font">Les inscriptions sont ouvertes !</div>
                        @else
                            <div class="esilan-detail red-font">Inscriptions fermées :/</div>
                        @endif
                        {{ HTML::image('img/round-add-button.png', 'more informations') }}
                    </div>
                    {{ HTML::image('upload/'.$esilan->imgName, 'Affiche'.$esilan->name, array('class' => 'esilan-poster')) }}
                </a>
            </div>
        </article>
    @endif
    </div>
</section>
@endsection