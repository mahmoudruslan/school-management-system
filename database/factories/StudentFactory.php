<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;


/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TheParent;
use App\Models\Nationality;
use App\Models\BloodType;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        $grade_ids = Grade::pluck('id');
        $classrooms = Classroom::select('id', 'grade_id')->get();
        $sections = Section::select('id', 'classroom_id')->get();
        return [
            'name_ar' => $this->faker->name,
            'name_en' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '11111111',
            'student_nationality_id' => Nationality::all()->random()->id,
            'student_blood_type_id' => BloodType::all()->unique()->random()->id,
            'date_of_birth' => $this->faker->date(),
            'religion' => 1,
            'grade_id' => $grade_id = $grade_ids->random(),
            'classroom_id' => $classroom_id = $classrooms->where('grade_id',$grade_id)->random()->id,
            'section_id' => $sections->where('classroom_id', $classroom_id)->random()->id,
            'parent_id' => TheParent::all()->unique()->random()->id,
            'joining_date' => $this->faker->date(),
            'gender' => 1,
            'student_address' => $this->faker->sentence(4),
            'entry_status' => 1,
        ];
    }

}
