<?php

use App\models\Student;
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
                'email' => $x['en'].rand('1','10').Str::random(3).'.gmail.com',
                'password' => Hash::make('11111111'),
                'nationality_id' => rand('1','30'),
                'blood_type_id' => rand('1','8'),
                'date_of_birth' => '2006-5-06',
                'religion_id' => rand('1','3'),
                'grade_id' => 1,
                'classroom_id' => 1,
                'parent_id' => rand('1','6'),
                'academic_year' => '2020-5-06',
                'gender' => 1,
                'address' => 'القاهرة',
                'entry_status' => 1

            ]);
        }
    }
}
