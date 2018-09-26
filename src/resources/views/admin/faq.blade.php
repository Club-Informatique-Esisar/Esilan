@extends('layouts.admin')

@section('pageTitle')
- FAQ
@endsection

@section('content')
<div class="container">
    <form class ="form-faq" method="post" action="{{ url('/admin/faq')}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="valid-order">
            <input id="place-order" class="btn" name="button" type="submit" value="Modifier" />
        </div>
        <!-- FAQ -->
        <fieldset> 
            <legend>Édition de la FAQ</legend>

            <div class="form-full">
                <label for="inputDesc">Description</label>
                <textarea id="inputDesc" name="descFAQ" required>{{ $faq->desc }}</textarea>
            </div>
        </fieldset>
    </form>
</div>
@endsection