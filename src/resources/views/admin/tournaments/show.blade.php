@extends('layouts.admin')

@section('pageTitle')
- Tournois - {{$tournament->name}}
@endsection

@section('content')
<div class="container">
    <form class ="form-tournament" method="post" action="{{ url('/admin/tournaments')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="commande" value="{{ $opt }}">
        <input type="hidden" name="idTournament" value="{{ $tournament->id }}">

        <div class="valid-order">
            @if ($opt == "create")
            <input id="place-order" class="btn btn-blue" name="button" type="submit" value="Créer" />
            @else 
            <input id="place-order" class="btn btn-blue" name="button" type="submit" value="Modifier" />
            @endif
        </div>
        <!-- TOURNAMENT -->
        <fieldset>
            @if ($opt == "create")
            <legend>Création d'un Tournois</legend>
            @else 
            <legend>Édition d'un Tournois</legend>
            @endif

            <div class="form-inline">
                <div class="form-simple form-element">
                    <label for="inputTitle">Nom du Tournois <span class="required">*</span></label>
                    <input type="text" id="inputTitle" name="titletournament" placeholder="Les 24h de TrackMania" value="{{ $tournament->name }}" required>
                </div>
                
                <div class="form-double">
                    <div class="form-element">
                        <label for="inputBeginDate">Date de début <span class="required">*</span></label>
                        @if(($opt == "create") && $esilanPreselected)
                            <input type="date" id="inputBeginDate" name="beginDate" value="{{ $esilanPreselected->beginDate->format("Y-m-d") }}" required>
                        @else
                            <input type="date" id="inputBeginDate" name="beginDate" value="{{ $tournament->beginDate->format("Y-m-d") }}" required>
                        @endif
                    </div>

                    <div class="form-element">
                        <label for="inputBeginTime">Heure de début <span class="required">*</span></label>
                    @if(($opt == "create") && $esilanPreselected)
                        <input type="time" id="inputbeginTime" name="beginTime" value="{{ $esilanPreselected->beginDate->format("H:i") }}" required>
                    @else
                        <input type="time"  id="inputBeginTime" name="beginTime" value="{{ $tournament->beginDate->format("H:i") }}" required>
                    @endif
                    </div>
                </div>
                <div class="form-double">
                    <div class="form-element">
                        <label for="inputEndDate">Date de Fin <span class="required">*</span></label>
                    @if(($opt == "create") && $esilanPreselected)
                        <input type="date" id="inputEndDate" name="endDate" value="{{ $esilanPreselected->endDate->format("Y-m-d") }}" required>
                    @else
                        <input type="date" id="inputEndDate" name="endDate" value="{{ $tournament->endDate->format("Y-m-d") }}" required>
                    @endif
                    </div>
                    <div class="form-element">
                        <label for="inputEndTime">Heure de fin <span class="required">*</span></label>
                    @if(($opt == "create") && $esilanPreselected)
                        <input type="time" id="inputEndTime" name="endTime" value="{{ $esilanPreselected->endDate->format("H:i") }}" required>
                    @else
                        <input type="time" id="inputEndTime" name="endTime" value="{{ $tournament->endDate->format("H:i") }}" required>
                    @endif
                    </div>
                </div>

            </div>

            {{-- ESILAN --}}
            <div class="form-inline">

            @if ($opt == "update")
                <div class="form-simple form-element">
                    <p>Esilan : {{ $tournament->esilan->name }}</p>
                    <img class="img-fullable select-img" src="{{ asset($tournament->esilan->fullImgPathOrDefault()) }}" >
                </div>
            @else
                <div class="form-simple form-element">
                    <label for="inputIdEsilan">Esilan <span class="required">*</span></label>
                    <select name="idEsilanTournament" id="inputIdEsilan">
                @foreach($esilanArray as $esilanTmp)
                    @if( ($opt == "create") && ($esilanPreselected && ($esilanTmp->id == $esilanPreselected->id)) )
                        <option value="{{ $esilanTmp->id }}" selected>{{ $esilanTmp->name }} ({{ $esilanTmp->tournaments()->count() }} tournois)</option>
                    @else
                        <option value="{{ $esilanTmp->id }}">{{ $esilanTmp->name }} ({{ $esilanTmp->tournaments()->count()}} tournois)</option>
                    @endif
                @endforeach
                    </select>
                    <img class="img-fullable select-img" src="" >
                </div>
            @endif
            </div>

            {{-- Game --}}
            <div class="form-inline">
                <div class="form-simple form-element">
                    <label for="inputIdGame">Jeu <span class="required">*</span></label>
                    <select name="idGameTournament" id="inputIdGame">

                @foreach($gamesArray as $gameLoop)
                    @if(($opt == "create") && $gamePreselected && ($gameLoop->id == $gamePreselected->id))
                        <option value="{{ $gameLoop->id }}" selected>{{ $gameLoop->name }}</option>
                    @elseif( $opt == "update" && ($gameLoop->id == $tournament->game->id) )
                        <option value="{{ $gameLoop->id }}" selected>{{ $gameLoop->name }}</option>
                    @else
                        <option value="{{ $gameLoop->id }}">{{ $gameLoop->name }}</option>
                    @endif
                @endforeach

                    </select>
                    <img class="img-fullable select-img" src="">
                </div>
            </div>
            <div class="form-inline">
                <label>Quelle image choisir : <span class="required">*</span></label>
            @if($tournament->useGameImg)
                <div class="form-element">
                    <label class="radio"><input type="radio" name="inputSwitchImg" value="game_img" checked>Utiliser l'image du jeu</label>
                </div>
                <div class="form-element">
                    <label class="radio"><input type="radio" name="inputSwitchImg" value="own_img" >Téléverser une image<input type="file" name="imgTournament"></label>
                </div>
            @else
                <div class="form-element">
                    <label class="radio"><input type="radio" name="inputSwitchImg" value="game_img">Utiliser l'image du jeu</label>
                </div>
                <div class="form-element">
                    <label class="radio"><input type="radio" name="inputSwitchImg" value="own_img" checked>Téléverser une image<input type="file" name="imgTournament"></label>
                </div>
            @endif
            </div>
        </fieldset>
    </form>
</div>
@endsection