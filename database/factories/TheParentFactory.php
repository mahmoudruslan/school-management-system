<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Nationality;
use App\Models\TheParent;

class TheParentFactory extends Factory
{

    protected $model = TheParent::class;
    public function definition()
    {
            return [
    'father_name_ar'=>$this->faker->name,
    'father_name_en'=>$this->faker->name,
    'mother_name_ar'=>$this->faker->name,
    'mother_name_en'=>$this->faker->name,
    'father_national_id'=> rand(11111111111111, 99999999999999),
    'father_phone'=> '01014'.rand(200000, 80000),
    'father_job_ar'=>$this->faker->word,
    'father_job_en'=>$this->faker->word,
    'father_nationality_id'=> Nationality::all()->random()->id,
    'mother_national_id'=> rand(11111111111111, 99999999999999)
        ];
    }
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

}
