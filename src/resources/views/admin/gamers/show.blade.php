@extends('layouts.admin')

@section('pageTitle')
- Utilisateur - {{$user->name}}
@endsection

@section('content')
<div class="container">
    <form class ="form-tournament" method="post" action="{{ url('/admin/gamers')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="idUser" value="{{ $user->id }}">

        <div class="valid-order">
            <input id="place-order" class="btn" name="button" type="submit" value="Modifier" />
        </div>

        <!-- USER -->
        <fieldset>
            <legend>Édition d'un Utilisateur</legend>

            <div class="form-small">
                <div class="form-simple form-element">
                    <label for="inputTitle" >Nom du Gamer</label>
                    <input type="text" id="inputTitle" value="{{ $user->name }}" disabled>
                </div>
                <div class="form-simple form-element">
                    <label for="inputEmail" >Email du Gamer</label>
                    <input type="text" id="inputEmail" value="{{ $user->email }}" disabled>
                </div>

                <div class="form-simple form-element">
                    <label for="inputRole">Role <span class="required">*</span></label>
                    <select name="role" id="inputRole">
                @foreach($roleArray as $role)
                    @if($role == $user->role)
                        <option value="{{ $role }}" selected>{{ $role }}</option>
                    @else
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endif
                @endforeach
                    </select>
                </div>
            </div>

        </fieldset>
    </form>
</div>
@endsection