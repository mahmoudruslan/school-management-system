<?php

use Illuminate\Database\Seeder;
use \App\models\Gender;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();
        $genders = [
            [
                'ar' => 'ذكر',
                'en' => 'Male'
            ],
            [
                'ar' => 'أنثى',
                'en' => 'Female'
            ]


        ];
        foreach ($genders as $gender){
            Gender::create([

                'name_ar' => $gender['ar'],
                'name_en' =>  $gender['en'],


            ]);
            }


        }


}
