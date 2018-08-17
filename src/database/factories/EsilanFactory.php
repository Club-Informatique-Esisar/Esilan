<?php

use Faker\Generator as Faker;

$factory->define(App\Esilan::class, function (Faker $faker) {
    $dateLan1 = new DateTime("2018-07-03 19:00:00");
    $dateLan2 = new DateTime("2018-07-04 07:00:00");
    return [
        'name' => 'BatLAN',
        'desc' => $faker->text(1000),
        'imgName' => 'Affiche BatLAN.jpg',
        'beginDate' => $dateLan1,
        'endDate' => $dateLan2,
    ];
});
