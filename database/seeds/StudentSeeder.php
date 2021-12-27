<?php

use App\models\BloodType;
use App\models\Classroom;
use App\models\Nationality;
use App\models\Section;
use App\models\Student;
use App\models\TheParent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{


    public function run()
    {
        DB::table('students')->delete();

        $xs = [
            [
                'ar' => 'يوسف ربيع رزق السيد',
                'en' => 'youseff rabiea rezk elsyed',
            ],
            [
                'ar' =>  'أدهم هشام السيد الدسوقي',
                'en' =>  'adham hesham elsyed eldesoky',
            ],

            [
                'ar' => 'شريف سعد نبيل الشربيني',
                'en' => 'shereef saad nabile elsherbint',

            ],
            [
                'ar' => 'أحمد خالد يوسف توفيق',
                'en' => 'ahmed khaled youseff tawfeek',

            ],
            [
                'ar' =>  'زين أحمد محمد السيد',
                'en' =>  'zeen ahmed mohamed elsyed',

            ],

            [
                'ar' =>  'عمر محمد صلاح رية',
                'en' =>  'omar mohamed salah raya',

            ]

        ];

        foreach($xs as $x)
        {
            Student::create([
                'name_ar' => $x['ar'],
                'name_en' => $x['en'],
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('11111111'),
                'nationality_id' => Nationality::all()->unique()->random()->id,
                'blood_type_id' => BloodType::all()->unique()->random()->id,
                'date_of_birth' => '2006-5-06',
                'religion_id' => 1,
                'grade_id' => 1,
                'classroom_id' => Classroom::all()->unique()->random()->id,
                'section_id' => Section::all()->unique()->random()->id,
                'parent_id' => TheParent::all()->unique()->random()->id,
                'academic_year' => '2020-5-06',
                'gender' => 1,
                'address' => 'القاهرة',
                'entry_status' => 1

            ]);
        }
    }
}
