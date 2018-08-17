@extends('layouts.admin')

@section('pageTitle')
@if ($esilanChoosed)
- Ventes {{$esilanChoosed->name}}
@else
- Ventes
@endif
@endsection


@section('content')
<div class="container">
    <h2>Listes des Inscriptions</h2>

    <p>Rechercher une Esilan pour afficher les inscrits</p>    
    <form method="get" role="form">
        <select name="idEsilan">
    @foreach($esilans as $esilan)
        @if($esilan->id == $esilanChoosed->id)
        <option value="{{ $esilan->id }}" selected>{{ $esilan->name }}</option>
        @else
        <option value="{{ $esilan->id }}">{{ $esilan->name }}</option>
        @endif
    @endforeach
        </select>

        <input type="submit" class="button button-primary" value="Afficher les inscrits">
    </form>

    <table id="table" class="cell-border hover stripe">
        <thead>
            <tr>
                <th>Type de place</th>
                <th>Nom du gamer</th>
                <th>Email</th>
                <th>Date Inscription</th>
                <th>Date Validation</th>
                <th>Valider par</th>
                <th>État inscription</th>
            </tr>
        </thead>
        <tbody>
        @foreach($esilanChoosed->ticketTypes as $type)
            @foreach($type->tickets as $ticket)
            <tr>
                <td>{{ $type->name }}</td>
                <td>{{ $ticket->gamer->name }}</td>
                <td>{{ $ticket->gamer->email }}</td>
                <td>{!! $ticket->dateCreation->formatLocalized("%A %e %B %Y")." - <i>". $ticket->dateCreation->formatLocalized("%T")."</i>" !!}</td>
                
                @if($ticket->dateValidation == null)
                <td class="dateValidation"></td>
                <td class="validateBy"></td>
                <td>
                    <a class="btn-escroc" data-idEsilan="{{ $ticket->id }}" href="">Escroc</a>
                </td>
                @else
                <td>{!! $ticket->dateValidation->formatLocalized("%A %e %B %Y")." - <i>". $ticket->dateValidation->formatLocalized(" %T")."</i>" !!}</td>
                <td>{{ $ticket->userValidator->name }}</td>
                <td class="validateBy">
                    <a class="btn-payeur">A payé</a>
                </td>
                @endif
            </tr>
            @endforeach
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Type de place</th>
                <th>Nom du gamer</th>
                <th>Email</th>
                <th>Date Inscription</th>
                <th>Date Validation</th>
                <th>Valider par</th>
                <th>État inscription</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection