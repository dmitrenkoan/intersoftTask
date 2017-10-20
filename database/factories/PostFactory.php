<?php

use Faker\Generator as Faker;



$factory->define(App\Post::class, function (Faker $faker) {

    return [
        'title' => $faker->words(rand(2,5), true),
        'publication_date' => $faker->date(),
        'detail_text' => $faker->text(200),
    ];
});