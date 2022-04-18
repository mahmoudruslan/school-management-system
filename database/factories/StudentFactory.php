<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;


/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TheParent;
use App\Models\Nationality;
use App\Models\BloodType;
use App\Models\Section;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        $x = rand(1, 3);
        return [
            'name_ar' => $this->faker->name,
            'name_en' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'password' => '11111111',
            'student_nationality_id' => Nationality::all()->random()->id,
            'student_blood_type_id' => BloodType::all()->unique()->random()->id,
            'date_of_birth' => $this->faker->date(),
            'religion' => 1,
            'grade_id' => 1,
            'classroom_id' => $x,
            'section_id' => Section::where('classroom_id', $x)->get()->random()->id,
            'parent_id' => TheParent::all()->unique()->random()->id,
            'joining_date' => $this->faker->date(),
            'gender' => 1,
            'student_address' => $this->faker->sentence(4),
            'entry_status' => 1,
        ];
    }

}
