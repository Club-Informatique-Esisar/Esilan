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
            <input id="place-order" class="btn" name="button" type="submit" value="Créer" />
            @else 
            <input id="place-order" class="btn" name="button" type="submit" value="Modifier" />
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
                        <input type="date" id="inputBeginDate" name="beginDate" value="{{ $tournament->beginDate->format("Y-m-d") }}" required>
                    </div>

                    <div class="form-element">
                        <label for="inputBeginTime">Heure de début <span class="required">*</span></label>
                        <input type="time"  id="inputBeginTime" name="beginTime" value="{{ date('H:i', strtotime($tournament->beginDate)) }}" required>
                    </div>
                </div>
                <div class="form-double">
                    <div class="form-element">
                        <label for="inputEndDate">Date de Fin <span class="required">*</span></label>
                        <input type="date" id="inputEndDate" name="endDate" value="{{ date('Y-m-d', strtotime($tournament->endDate)) }}" required>
                    </div>
                    <div class="form-element">
                        <label for="inputEndTime">Heure de fin <span class="required">*</span></label>
                        <input type="time" id="inputEndTime" name="endTime" value="{{ date('H:i', strtotime($tournament->endDate)) }}" required>
                    </div>
                </div>

            </div>
            <div class="form-inline">
                <div class="form-simple form-element">
                    <label for="inputIdEsilan">Esilan <span class="required">*</span></label>
                    <select name="idEsilanTournament" id="inputIdEsilan">
                @foreach($esilanArray as $esilanTmp)
                    @if($esilanPreselected && $esilanTmp->id == $esilanPreselected->id)
                        <option value="{{ $esilanTmp->id }}" selected>{{ $esilanTmp->name }} ({{ $esilanTmp->tournaments()->count() }} tournois)</option>
                    @else
                        <option value="{{ $esilanTmp->id }}">{{ $esilanTmp->name }} ({{ $esilanTmp->tournaments()->count()}} tournois)</option>
                    @endif
                @endforeach
                    </select>
                    <img class="img-fullable select-img" src="" >
                </div>
            </div>
            <div class="form-inline">
                <div class="form-simple form-element">
                    <label for="inputIdGame">Jeu <span class="required">*</span></label>
                    <select name="idGameTournament" id="inputIdGame">

                @foreach($gamesArray as $gameLoop)
                    @if($gamePreselected && $gameLoop->id == $gamePreselected->id)
                        <option value="{{ $gameLoop->id }}" selected>{{ $gameLoop->name }}</option>
                    @else
                        <option value="{{ $gameLoop->id }}">{{ $gameLoop->name }}</option>
                    @endif
                @endforeach

                    </select>
                    <img class="img-fullable select-img" src="">
                </div>
            </div>

        </fieldset>
    </form>
</div>
@endsection