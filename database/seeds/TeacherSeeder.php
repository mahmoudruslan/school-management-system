<?php

use App\models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->delete();

        $xs = [
            [
                'ar' => 'محمد صلاح رية',
                'en' => 'mohamed salah raya',
            ],
            [
                'ar' => 'أحمد محمد السيد',
                'en' => 'ahmed mohamed elsyed',
            ],
            [
                'ar' => 'خالد يوسف توفيق',
                'en' => 'khaled youseff tawfeek',
            ],

            [
                'ar' => 'سعد نبيل الشربيني',
                'en' => 'saad nabile elsherbint',
            ],

            [
                'ar' => 'هشام السيد الدسوقي',
                'en' => 'hesham elsyed eldesoky',
            ],

            [
                'ar' => 'ربيع رزق السيد',
                'en' => 'rabiea rezk elsyed',
            ],
        ];
        foreach($xs as $x)
        {
            Teacher::create([
                'email'=> $x['en'].rand(1, 12).Str::random(1).'.gmail.com',
                'password'=> Hash::make('11111111'),
                'name_ar'=> $x['ar'],
                'name_en'=> $x['en'],
                'gender'=> 1,
                'specialization_id'=> rand(1, 12),
                'joining_date'=> '2020-5-06',
                'address'=> 'القاهرة',
            ]);
        }
    }
}
