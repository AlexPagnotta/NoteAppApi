<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Note::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        'text' => $faker->sentence(15),
        'user_id' => App\User::all()->random()->id,
    ];
});
