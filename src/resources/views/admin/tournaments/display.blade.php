@extends('layouts.admin')

@section('pageTitle')
- Tournois
@endsection

@section('content')
<div class="container">
    <h2>Listes des Tournois</h2>

    {{-- <a class="btn" href="{{ url('/admin/tournaments/new') }}">Renseigner un nouveau jeu</a> --}}

    {{-- CHOIX ESILAN --}}
    <p>Rechercher une Esilan pour afficher les tournois</p>    
    <form method="get" role="form">
        <select name="idEsilan">
    @foreach($esilans as $esilanTmp)
        @if($esilan && $esilanTmp->id == $esilan->id)
        <option value="{{ $esilanTmp->id }}" selected>{{ $esilanTmp->name }} ({{ $esilanTmp->tournaments()->count() }} tournois)</option>
        @else
        <option value="{{ $esilanTmp->id }}">{{ $esilanTmp->name }} ({{ $esilanTmp->tournaments()->count()}} tournois)</option>
        @endif
    @endforeach
        </select>

        <input type="submit" class="button button-primary" value="Afficher les tournois">
    </form>

    @if($esilan)
    <div>
        <img src="{{ asset('upload/'.$esilan->imgName) }}" width="100px">
        <p>{{ $esilan->name }}</p>
        <p>{{ $esilan->beginDate }} - {{ $esilan->endDate }}</p>

        <a class="btn" href="{{ url("/admin/tournaments/new?idEsilan=".$esilan->id) }}">Ajouter un tournois</a>
    </div>
    @endif

    @if($esilan && $esilan->tournaments->count() > 0 )
    <table id="table" class="cell-border hover stripe">
        <thead>
            <tr>
                <th colspan="4">
                <th colspan="{{ $esilan->ticketTypes->count() }}">Type de Ticket</th>
                <th></th>
            </tr>
            <tr>
                <th class="sortable">Tournois</th>
                <th class="sortable">Jeux</th>
                <th class="sortable">Début</th>
                <th class="sortable">Fin</th>
            @foreach($esilan->ticketTypes as $type)
                <th class="sortable">{{ $type->name }}</th>
            @endforeach
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($esilan->tournaments as $tournament)
            <tr>
                <td><a href="{{url("/admin/tournaments/$tournament->id")}}">{{ $tournament->name }}</a></td>
                <td>{{ $tournament->game->name }}</td>
                <td>{{ $tournament->beginDate }}</td>
                <td>{{ $tournament->endDate }}</td>

            @foreach($esilan->ticketTypes as $type)
            @if($tournament->compatibleWithTicketType($type->id))
                <td class="type-tourn-compatible checkmark-container"    data-idTicketType="{{ $type->id }}" data-idTournament="{{ $tournament->id }}">
                    <span class="checkmark checkmark-checked"></span><span class="checkmark-text">Compatible</span>
                </td>
            @else
                <td class="type-tourn-notcompatible checkmark-container" data-idTicketType="{{ $type->id }}" data-idTournament="{{ $tournament->id }}">
                    <span class="checkmark"></span><span class="checkmark-text">Pas Compatible</span>
                </td>
            @endif
            @endforeach

                <td>
                    <form method="post" action="{{ url('/admin/tournaments')}}">
                        <input type="hidden" name="commande" value="remove">
                        <input type="hidden" name="idtournament" value="{{ $tournament->id }}">
                        {{-- <input class="degrow" type="image" src="{{ asset("img/dustbin.png") }}" alt="suppress tournament {{ $tournament->id}}" width="25px"> --}}
                        <span class="degrow" onclick="alert('Cette fonction implémenté ça dès qu une  politique de suppression sera déterminé.');"><img src="{{ asset("img/dustbin.png") }}" width="25px"></span>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Tournois</th>
                <th>Jeux</th>
                <th>Début</th>
                <th>Fin</th>
            @foreach($esilan->ticketTypes as $type)
                <th>{{ $type->name }}</th>
            @endforeach
                <th></th>
            </tr>
        </tfoot>
    </table>
    @endif
</div>
@endsection