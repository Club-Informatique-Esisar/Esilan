@extends('layouts.esilan.globalEsilan')

@section('pageTitle')
- Panier
@endsection

@section('pageBody')
<section id="page-body">

    <nav class="menu-nav">
        <div class="container nav-content clearfix">
            <ul>
                <li><a href="{{url("/esilan/".$esilan->id."?page=home") }}">Accueil</a></li>
                <li><a href="{{url("/esilan/".$esilan->id."?page=register") }}">Inscription</a></li>
                <li><a href="{{url("/esilan/".$esilan->id."?page=tournament") }}">Tournois</a></li>
            </ul>
        </div>
    </nav>

    <div class="container body-content clearfix">
        <h2>Modification de votre place</h2>
        <article class="clearfix">
            <div class="post-content clearfix">
            <form class="checkout" method="post" action="{{ url('/commande')}}">
                {{ csrf_field() }}
                    <div id="checkout-detail" class="clearfix">
                        <div class="col-1 ">
                            <fieldset>
                                <legend>Esilan</legend>
                                <div>
                                    <p>Vous possédez une place <span class="bold"> {{ $ticketType->name }}</span></p>
                                    <p class="description">{{ $ticketType->desc }}</p>
                                    
                                    <input class="hidden" type="text" name="ticketType" value="{{ $ticketType->id }}"/>
                                    <input class="hidden" type="text" name="editOrRegister" value="edit"/>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-2">
                            <fieldset>
                                <legend>Tournois</legend>
                                <div>
                                    <p>Voulez vous également vous inscrire (ou vous désinscrire) à un tournoi ?</p>
                                    @forelse ($ticketType->tournaments as $tournament)
                                        <div class="sub-product">
                                        @if (Auth::user()->isRegisterToTournament($tournament->id))
                                            <input id="{{ $tournament->name }}" type="checkbox" name="{{ "tournaments[$tournament->id]" }}" value="{{$tournament->id}}" checked/>
                                        @else
                                            <input id="{{ $tournament->name }}" type="checkbox" name="{{ "tournaments[$tournament->id]" }}" value="{{$tournament->id}}"/>
                                        @endif
                                            <label for="{{ $tournament->name }}">
                                                <img src="{{ asset($tournament->fullImgPathOrDefault("s")) }}">
                                                {{ $tournament->name }}</label>
                                        </div>
                                    @empty
                                        <p>Aucun tournois n'est disponible pour ce ticket d'Esilan.</p>
                                    @endforelse
                                    </div>                            		
	
                            </fieldset>
                        </div>
                    </div>
                    <h3 id="order-review-heading">Votre commande :</h3>
                    <div id="order-review">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Produit</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="order-total">
                                    <th class="text-right">Montant Total</th>
                                    <td class="bold">{{ $ticketType->price }}€</td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr class="cart_item">
                                    <td class="product-name">{{ $ticketType->name }}</td>
                                    <td class="product-total">{{ $ticketType->price }}€</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="valid-order">
                        <input id="place-order" class="btn btn-blue" name="button" type="submit" value="Valider l'inscription" />
                    </div>
                    
                </form>
            </div>
        </article>
    </div>
</section>

@endsection