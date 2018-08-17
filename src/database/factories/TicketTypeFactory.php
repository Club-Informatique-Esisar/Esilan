<?php

use Faker\Generator as Faker;

$factory->define(App\TicketType::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'desc' => "Cette place vous permet de venir. Vachement cool nan ?",
        'price' => $faker->randomFloat(2,1.00,10.00),
        'maxTicket' =>  $faker->randomNumber(2),
    ];
});
