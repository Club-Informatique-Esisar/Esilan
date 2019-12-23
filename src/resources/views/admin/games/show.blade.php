@extends('layouts.admin')

@section('pageTitle')
- Jeux - {{$game->name}}
@endsection

@section('content')
<div class="container">
    <form class ="form-game" method="post" action="{{ url('/admin/games')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="commande" value="{{ $opt }}">
        <input type="hidden" name="idGame" value="{{ $game->id }}">

        <div class="valid-order">
            @if ($opt == "create")
            <input id="place-order" class="btn btn-blue" name="button" type="submit" value="Créer" />
            @else 
            <input id="place-order" class="btn btn-blue" name="button" type="submit" value="Modifier" />
            @endif
        </div>
        <!-- GAME -->
        <fieldset>
            @if ($opt == "create")
            <legend>Création d'un Jeu</legend>
            @else 
            <legend>Édition d'un Jeu</legend>
            @endif

            <div class="form-inline">
                <div class="form-simple form-element">
                    <label for="inputTitle">Nom du Jeu <span class="required">*</span></label>
                    <input type="text" id="inputTitle" name="titleGame" placeholder="Françoise Hotesse de Caisse Simulator" value="{{ $game->name }}" required>
                </div>
            </div>
            <div class="form-inline">
            @if($game->imgName)
                <img class="img-fullable" src="{{ asset('upload/'.$game->imgName) }}" height="210px"> 
            @endif
                <div class="form-simple form-element">
                    <label for="inputImg">Affiche du Jeu <span class="required">*</span></label>
                @if ($opt == "create")
                    <input type="file" name="img" id="inputImg" required>
                @else 
                    <input type="file" name="img" id="inputImg">
                @endif
                </div>
            </div>
            <div class="form-full">
                <label for="inputDesc">Description</label>
                <textarea id="inputDesc" name="descGame" required>{{ $game->desc }}</textarea>
            </div>
        </fieldset>
    </form>
</div>
@endsection