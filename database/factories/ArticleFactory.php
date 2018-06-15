<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'body' => $faker->text,
        'categroy' => $faker->text,
    ];
});
