<?php

use Faker\Generator;

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'full_name' => $faker->word,
        'email' => $faker->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
//        'dna_center_id' => $faker->randomNumber(),
        'remember_token' => str_random(10),
    ];
});
