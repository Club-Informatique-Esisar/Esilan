@extends('layouts.admin')

@section('pageTitle')
- Esilan
@endsection

@section('content')
<div class="container">
    <h2>Listes des Esilan</h2>

    <a class="btn" href="{{ url('/admin/esilan/new') }}">Créer une nouvelle Esilan</a>

    <table id="table" class="cell-border hover stripe">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Nombre de type de place</th>
                <th>Nombre de places vendus</th>
                <th>Nombre de places disponibles</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($esilans as $esilan)
            <tr>
                <td><a href="{{url("/admin/esilan/$esilan->id")}}">{{ $esilan->name }}</a></td>
                <td>{{ $esilan->beginDate }}</td>
                <td>{{ $esilan->endDate }}</td>
                <td>{{ $esilan->ticketTypes->count() }}</td>
                <td>{{ $esilan->nbPlacesSales() }}</td>
                <td>{{ $esilan->nbPlacesAvailable() }}</td>
                <td>
                    <form method="post" action="{{ url('/admin/esilan')}}">
                        <input type="hidden" name="commande" value="remove">
                        <input type="hidden" name="idEsilan" value="{{ $esilan->id }}">
                        {{-- <input class="degrow" type="image" src="{{ asset("img/dustbin.png") }}" alt="suppress esilan {{ $esilan->id}}" width="25px"> --}}
                        <span class="degrow" onclick="alert('Cette fonction implémenté ça dès qu une  politique de suppression sera déterminé.');"><img src="{{ asset("img/dustbin.png") }}" width="25px"></span>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Nom</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Nombre de type de place</th>
                <th>Nombre de places disponibles</th>
                <th>Nombre de places vendus</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection