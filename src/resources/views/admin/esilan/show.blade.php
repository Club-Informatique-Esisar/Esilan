@extends('layouts.admin')

@section('pageTitle')
- Esilan - {{$esilan->name}}
@endsection

@section('content')
<div class="container">
    <form class ="form-esilan" method="post" action="{{ url('/admin/esilan')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="commande" value="{{ $opt }}">
        <input type="hidden" name="idEsilan" value="{{ $esilan->id }}">

        <div class="valid-order">
            @if ($opt == "create")
            <input id="place-order" class="btn" name="button" type="submit" value="Créer" />
            @else 
            <input id="place-order" class="btn" name="button" type="submit" value="Modifier" />
            @endif
        </div>
        <!-- ESILAN -->
        <fieldset>
            @if ($opt == "create")
            <legend>Création d'une Esilan</legend>
            @else 
            <legend>Édition d'une Esilan</legend>
            @endif

            <div class="form-inline">
                <div class="form-simple form-element">
                    <label for="inputTitle">Nom de l'Esilan <span class="required">*</span></label>
                    <input type="text" id="inputTitle" name="titleEsilan" placeholder="LANal" value="{{ $esilan->name }}" required>
                </div>

                <div class="form-double">
                    <div class="form-element">
                        <label for="inputBeginDate">Date de début <span class="required">*</span></label>
                        <input type="date" id="inputBeginDate" name="beginDate" value="{{ date('Y-m-d', strtotime($esilan->beginDate)) }}" required>
                    </div>

                    <div class="form-element">
                        <label for="inputBeginTime">Heure de début <span class="required">*</span></label>
                        <input type="time"  id="inputBeginTime" name="beginTime" value="{{ date('H:i', strtotime($esilan->beginDate)) }}" required>
                    </div>
                </div>
                <div class="form-double">
                    <div class="form-element">
                        <label for="inputEndDate">Date de Fin <span class="required">*</span></label>
                        <input type="date" id="inputEndDate" name="endDate" value="{{ date('Y-m-d', strtotime($esilan->endDate)) }}" required>
                    </div>
                    <div class="form-element">
                        <label for="inputEndTime">Heure de fin <span class="required">*</span></label>
                        <input type="time" id="inputEndTime" name="endTime" value="{{ date('H:i', strtotime($esilan->endDate)) }}" required>
                    </div>
                </div>
            </div>
            <div class="form-inline">
            @if($esilan->imgName)
                <img class="img-fullable" src="{{ asset('upload/'.$esilan->imgName) }}" height="210px"> 
            @endif
                <div class="form-simple form-element">
                    <label for="inputImg">Affiche de l'EsiLAN <span class="required">*</span></label>
                @if ($opt == "create")
                    <input type="file" name="img" id="inputImg" required>
                @else 
                    <input type="file" name="img" id="inputImg">
                @endif
                </div>
            </div>
            <div class="form-full">
                <label for="inputDesc">Description</label>
                <textarea id="inputDesc" name="descEsilan" required>{{ $esilan->desc }}</textarea>
            </div>
        </fieldset>

        <!-- TICKET TYPE -->
        <div class="ticket-types">
            @foreach($esilan->ticketTypes as $ticketType)
            <div class="ticket-type ticket-type-fill">
                <input type="hidden" name="{{ "ticketTypes[$loop->iteration][id]" }}" value="{{ $ticketType->id }}">
                <fieldset class="field-ticket-type">
                    <legend>Type de place</legend>

                    <div class="form-simple form-element">
                        <label for="{{ 'inputTitleTicketType'.$loop->iteration }}">Nom de la place<span class="required">*</span></label>
                        <input type="text" id="{{ 'inputTitleTicketType'.$loop->iteration }}" name="{{ "ticketTypes[$loop->iteration][ticketTypeName]" }}" placeholder="Place PC" value="{{ $ticketType->name }}" required>
                    </div>
                    <div class="form-simple form-element">
                        <label for="{{ 'inputDescTicketType'.$loop->iteration }}">Description<span class="required">*</span></label>
                        <textarea id="{{ 'inputDescTicketType'.$loop->iteration }}" name="{{ "ticketTypes[$loop->iteration][ticketTypeDesc]" }}" required>{{ $ticketType->desc }}</textarea>
                    </div>

                    <div class="form-double">
                        <div class="form-element">
                            <label for="{{ 'inputPriceTicketType'.$loop->iteration }}">Prix de la place (en €)<span class="required">*</span></label>
                            <input type="number" id="{{ 'inputPriceTicketType'.$loop->iteration }}" name="{{ "ticketTypes[$loop->iteration][ticketTypePrice]" }}" placeholder="5,00" pattern="^\d+(\.|\,)\d{2}$" value="{{ $ticketType->price }}" step="any" required>
                        </div>

                        <div class="form-element">
                            <label for="{{ 'inputNumPlaceTicketType'.$loop->iteration }}">Nombre de ticket<span class="required">*</span></label>
                            <input type="number" id="{{ 'inputNumPlaceTicketType'.$loop->iteration }}" name="{{ "ticketTypes[$loop->iteration][ticketTypeMax]" }}" value="{{ $ticketType->maxTicket }}" required>
                        </div>
                    </div>
                </fieldset>
            </div>
            @endforeach

            @if ($opt == "create")
            <div class="ticket-type ticket-type-empty" id="addTicketType">
                <span class="vertical-align-hack"></span>
                <img src="{{ asset("img/plus.png") }}">
            </div>
            @endif
        </div>
    </form>
</div>
@endsection