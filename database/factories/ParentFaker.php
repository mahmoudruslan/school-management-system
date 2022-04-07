<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\models\TheParent;
use Faker\Generator as Faker;

$factory->define(TheParent::class, function (Faker $faker) {
    return [
'father_name_ar'=>$faker->name,
'father_name_en'=>$faker->name,
'mother_name_ar'=>$faker->name,
'mother_name_en'=>$faker->name,
'father_national_id'=> rand(11111111111111,99999999999999),
'father_phone'=> '01014'.rand(200000,80000),
'father_job_ar'=>$faker->word,
'father_job_en'=>$faker->word,
'father_nationality_id'=> rand(2,30),
'mother_national_id'=> rand(11111111111111,99999999999999)
    ];
});
