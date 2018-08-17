@extends('layouts.admin')

@section('pageTitle')
- Jeux
@endsection

@section('content')
<div class="container">
    <h2>Listes des Jeux</h2>

    <a class="btn" href="{{ url('/admin/games/new') }}">Renseigner un nouveau jeu</a>

    <table id="table" class="cell-border hover stripe">
        <thead>
            <tr>
                <th>Nom</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($games as $game)
            <tr>
                <td><a href="{{url("/admin/games/$game->id")}}">{{ $game->name }}</a></td>
                <td>
                    <form method="post" action="{{ url('/admin/games')}}">
                        <input type="hidden" name="commande" value="remove">
                        <input type="hidden" name="idGame" value="{{ $game->id }}">
                        {{-- <input class="degrow" type="image" src="{{ asset("img/dustbin.png") }}" alt="suppress game {{ $game->id}}" width="25px"> --}}
                        <span class="degrow" onclick="alert('Cette fonction implémenté ça dès qu une  politique de suppression sera déterminé.');"><img src="{{ asset("img/dustbin.png") }}" width="25px"></span>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Nom</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection