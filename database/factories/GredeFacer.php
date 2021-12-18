<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Grade;
use Faker\Generator as Faker;

$factory->define(Grade::class, function (Faker $faker) {
    return [
        'name_ar' => $faker->name,
        'name_en' => $faker->name,
        'notes' => $faker->sentence
    ];
});
