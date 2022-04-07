<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Student;
use App\models\TheParent;
use App\models\Nationality;
use App\models\BloodType;
use App\models\Section;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    $x = rand(1, 3);
    return [
        

'name_ar' => $faker->name,
'name_en' => $faker->name,
'email' => $faker->unique()->email,
'password' => '11111111',
'student_nationality_id' => Nationality::all()->random()->id,
'student_blood_type_id' => BloodType::all()->unique()->random()->id,
'date_of_birth' => $faker->date(),
'religion' => 1,
'grade_id' => 1,
'classroom_id' => $x,
'section_id' => Section::where('classroom_id', $x)->get()->random()->id,
'parent_id' => TheParent::all()->unique()->random()->id,
'joining_date' => $faker->date(),
'gender' => 1,
'student_address' => $faker->sentence(4),
'entry_status' => 1,
    ];
});
