<?php

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'desc' => $faker->text(1000),
        'imgName' => 'Affiche BatLAN.jpg',
    ];
});
