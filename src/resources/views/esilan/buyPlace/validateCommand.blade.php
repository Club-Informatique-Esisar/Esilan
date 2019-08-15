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
        <h2>Réserver sa place !</h2>
        <article class="clearfix">
            <div class="post-content clearfix">
            <form class="checkout" method="post" action="{{ url('/commande')}}">
                {{ csrf_field() }}
                    <div id="checkout-detail" class="clearfix">
                        <div class="col-1 ">
                            <fieldset>
                                <legend>Esilan</legend>
                                <div>
                                    <p>Vous avez sélectionné une place <span class="bold"> {{ $ticketType->name }}</span></p>
                                    <p class="description">{{ $ticketType->desc }}</p>
                                    
                                    
                                    <input class="hidden" type="text" name="ticketType" value="{{ $ticketType->id }}"/>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-2">
                            <fieldset>
                                <legend>Tournois</legend>
                                <div>
                                    @forelse ($ticketType->tournaments as $tournament)
                                    @if ($loop->first)
                                        <p>Voulez vous également vous inscrire à un tournoi ?</p>
                                    @endif
                                        <div class="sub-product">
                                        <input id="{{ $tournament->name }}" type="checkbox" name="{{ "tournaments[$tournament->id]" }}" value="{{$tournament->id}}"/>
                                            <label for="{{ $tournament->name }}">{{ $tournament->name }}</label>
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
                        <input id="place-order" class="btn" name="button" type="submit" value="Valider l'inscription" />
                    </div>
                    
                </form>
            </div>
        </article>
    </div>
</section>

@endsection