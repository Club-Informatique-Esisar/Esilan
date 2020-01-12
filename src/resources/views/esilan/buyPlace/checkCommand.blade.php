@extends('layouts.esilan.globalEsilan')

@section('pageTitle')
- Votre commande est validé !
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
        <h2>Commande</h2>
        <article class="clearfix">
            <div class="post-content clearfix">
                <div class="alert alert-success">
                    <p>Votre commande a été validée avec succès !</p>
                    <p>Pour les règlements, nous serons disponibles <span class="bold">du lundi au jeudi, aux pauses de 10h, 12h et 15h à la cafet' !</span></p>
                    <p>Si vous n’avez pas la possibilité de régler avant l’Esilan (extérieurs, stages …), <span class="bold">prévenez-nous par email à club.informatique@esisar.grenoble-inp.fr</span></p>
                </div>
                <div>
                    <ul class="order-details clearfix">
                        <li class="order">Commande :<span class="bold">{{ $ticket->id }}</span></li>
                        <li class="date">Date :<span class="bold">
                            {{ $ticket->dateCreation->formatLocalized('%A %d %B %G - %T') }}</span></li>
                        <li class="total">Total :<span class="bold">5,00&nbsp;€</span></li>
                        <li class="method">Méthode de paiement :<span class="bold">Espèce</span></li>
                    </ul>
                </div>
                <div id="order-review">
                    <h2>Détails de l'inscriptions</h2>
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
                                <td class="bold">{{ $ticket->ticketType->price }}€</td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr class="cart_item">
                                <td class="product-name">{{ $ticket->ticketType->name }}</td>
                                <td class="product-total">{{ $ticket->ticketType->price }}€</td>
                            </tr>
                        @foreach($participations as $participation)
                            <tr class="cart_item">
                                <td class="product-name">{{ $participation->tournament->name }}</td>
                                <td class="product-total"> - </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="valid-order">
                    <a href="{{url("/esilan/".$esilan->id)}}" id="place-order" class="btn btn-blue">Retourner à l'Esilan</a>
                </div>

            </div>
        </article>
    </div>
</section>
@endsection