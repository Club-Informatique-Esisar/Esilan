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
        @if($esilanChoosed && $esilan->id == $esilanChoosed->id)
        <option value="{{ $esilan->id }}" selected>{{ $esilan->name }}</option>
        @else
        <option value="{{ $esilan->id }}">{{ $esilan->name }}</option>
        @endif
    @endforeach
        </select>

        <input type="submit" class="button button-primary" value="Afficher les inscrits">
    </form>

    @if($esilanChoosed)
    <table id="table" class="cell-border hover stripe">
        <thead>
            <tr>
                <th class="column-type-place">Type de place</th>
                <th class="column-gamer-data">Gamer</th>
                {{-- <th>Email</th> --}}
                <th>Date Inscription</th>
                <th class="column-ticket-validation">Validation</th>
                {{-- <th>Valider par</th> --}}
                <th>État inscription</th>
            </tr>
        </thead>
        <tbody>
        @foreach($esilanChoosed->ticketTypes as $type)
            @foreach($type->tickets as $ticket)
            <tr>
                <td class="column-type-place">{{ $type->name }}</td> 
                <td class="column-gamer-data">{{ $ticket->gamer->name }}
                    <p class="mail">{{ $ticket->gamer->email }}</p>
                </td>
                {{-- <td>{{ $ticket->gamer->email }}</td> --}}
                <td class="column-ticket-inscription">{!! $ticket->dateCreation->formatLocalized("%A %e %B %Y")." - <i>". $ticket->dateCreation->formatLocalized("%T")."</i>" !!}</td>
                
                @if($ticket->dateValidation == null)
                <td class="column-ticket-validation"></td>
                {{-- <td class="validateBy"></td> --}}
                <td>
                    <a class="btn-escroc" data-nameEsilan="{{ $esilanChoosed->name }}" data-nameGamer="{{ $ticket->gamer->name }}" data-idTicket="{{ $ticket->id }}" href="">Escroc</a>
                </td>
                @else
                <td class="column-ticket-validation">
                    {!! $ticket->dateValidation->formatLocalized("%A %e %B %Y")." <span class=\"time\">à ". $ticket->dateValidation->formatLocalized(" %T")."</span>" !!}
                    <span class="validation">Par <span class="validator">{{ $ticket->userValidator->name }}</span></div>
                </td>
                {{-- <td class="validateBy">{{ $ticket->userValidator->name }}</td> --}}
                <td>
                    <a class="btn-payeur">A payé</a>
                </td>
                @endif
            </tr>
            @endforeach
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="column-type-place">Type de place</th>
                <th class="column-gamer-data">Gamer</th>
                {{-- <th>Email</th> --}}
                <th>Date Inscription</th>
                {{-- <th>Date Validation</th> --}}
                <th class="column-ticket-validation">Validation</th>
                <th>État inscription</th>
            </tr>
        </tfoot>
    </table>
    @endif
</div>
@endsection