@extends('layouts.admin')

@section('pageTitle')
- Utilisateurs
@endsection

@section('content')
<div class="container">
    <h2>Listes des G@m3r5</h2>

    <div class="clearfix">
        <form class="right" method="get" action="{{ url()->current()}}" >
            <input type="search" name="s" value="{{$searchValue}}" id="search-user">
            <input type="submit" value="Chercher un utilisateur">
        </form>
    </div>

    <table id="table-user" class="cell-border hover stripe">
        <thead>
            <tr>
                <th class="sortable">Pseudo</th>
                {{-- <th class="sortable">Nom</th> --}}
                <th class="sortable">Mail</th>
                <th class="sortable">Rôle</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($gamers as $gamer)
            <tr>
                <td><a href="{{url("/admin/gamers/$gamer->id")}}">{{ $gamer->name }}</a></td>
                {{-- <td>{{ $gamer->name }}</td> --}}
                <td>{{ $gamer->email }}</td>
                <td>{{ $gamer->role }}</td>

                <td>
                    <form method="post" action="{{ url('/admin/tournaments')}}">
                        <input type="hidden" name="commande" value="remove">
                        <input type="hidden" name="idGamer" value="{{ $gamer->id }}">
                        {{-- <input class="degrow" type="image" src="{{ asset("img/dustbin.png") }}" alt="suppress gamer {{ $gamer->id}}" width="25px"> --}}
                        <span class="degrow" onclick="alert('Cette fonction implémenté ça dès qu une  politique de suppression sera déterminé.');"><img src="{{ asset("img/dustbin.png") }}" width="25px"></span>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="sortable">Pseudo</th>
                {{-- <th class="sortable">Nom</th> --}}
                <th class="sortable">Mail</th>
                <th class="sortable">Rôle</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <div id="table-user-pagination" class="pagination-container clearfix">
        <p>Affichage des utilisateurs {{$gamers->firstItem()}} à {{$gamers->lastItem()}} pour un total de {{$gamers->total()}}</p>
        {{ $gamers->links() }}
    </div>

    {{-- <table id="table-user-search" class="cell-border hover stripe" style="display:none;">
        <thead>
            <tr>
                <th class="sortable">Pseudo</th>
                <th class="sortable">Mail</th>
                <th class="sortable">Rôle</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="table-user-search-content">

        </tbody>
        <tfoot>
            <tr>
                <th class="sortable">Pseudo</th>
                <th class="sortable">Mail</th>
                <th class="sortable">Rôle</th>
                <th></th>
            </tr>
        </tfoot>
    </table> --}}

</div>
@endsection