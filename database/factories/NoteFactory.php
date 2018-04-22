<?php

use Faker\Generator as Faker;

$factory->define(App\Note::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        'text' => $faker->sentence(5),
    ];
});
