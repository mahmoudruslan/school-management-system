<?php

use App\models\SchoolData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SchoolDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('school_data')->delete();
        SchoolData::create([
            'name_ar' => 'مدرستي',
            'name_en' => 'My School',
            'school_time' => 'morning',
            'school_rating' => 'Especially',
            'year_founded' => '2010',
            'grade' => 'Multiple',
            'phone' => '01092199683',
            'email' => Str::random(10).'@gmail.com',
            'school_manager' => 'mahmoud',
            'city' => 'cario',
            'address' => 'sdfsdf',
        ]);
    }
}
