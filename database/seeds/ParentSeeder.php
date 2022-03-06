<?php

use App\models\TheParent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('the_parents')->delete();

        $xs = [
            [
                'ar' => 'ربيع رزق السيد',
                'en' => 'rabiea rezk elsyed',
                'm_ar' => 'نها الشربيني السيد',
                'm_en' => 'noha elsherbiny elsyed',
                'j_ar' => 'دكتور',
                'j_en' => 'doctor',
            ],
            [
                'ar' =>  'هشام السيد الدسوقي',
                'en' =>  'hesham elsyed eldesoky',
                'm_ar' => 'عبير نبيل توفيق',
                'm_en' => 'abeer elsyed tawfeek',
                'j_ar' => 'معلم',
                'j_en' => 'teacher',
            ],
            [
                'ar' => 'سعد نبيل الشربيني',
                'en' => 'saad nabile elsherbint',
                'm_ar' => 'شادية محمد خالد',
                'm_en' => 'shadia mohamed khled',
                'j_ar' => 'معلم',
                'j_en' => 'teacher',
            ],
            [
                'ar' => 'خالد يوسف توفيق',
                'en' => 'khaled youseff tawfeek',
                'm_ar' => 'سمية ربيع الشربيني',
                'm_en' => 'samia rabeaa elsherbieny',
                'j_ar' => 'دكتور',
                'j_en' => 'doctor',
            ],
            [
                'ar' =>  'أحمد محمد السيد',
                'en' =>  'ahmed mohamed elsyed',
                'm_ar' => 'سهام السيد هشام',
                'm_en' => 'seham elsyed hesham',
                'j_ar' => 'دكتور',
                'j_en' => 'doctor',
            ],

            [
                'ar' =>  'محمد صلاح رية',
                'en' =>  'mohamed salah raya',
                'm_ar' => ' علياء السيد الدسوقي',
                'm_en' => 'aliaa elsyed eldesoky',
                'j_ar' => 'معلم',
                'j_en' => 'teacher',
            ],

        ];
        foreach($xs as $x)
        {
            TheParent::create([
                'email'=>  $x['en']. '.' .rand(1, 12).Str::random(1).'@gmail.com',
                'password'=> '11111111',
                'name_father_ar'=> $x['ar'],
                'name_father_en'=> $x['en'],
                'national_id_father'=> rand('1','30'),
                'passport_id_father'=> '4785693251',
                'phone_father'=> '01047856932',
                'job_father_ar'=> $x['j_ar'],
                'job_father_en'=> $x['j_en'],
                'nationality_father_id'=> rand('1','30'),
                'blood_Type_father_id'=> rand('1','8'),
                'religion_father_id'=> rand('1','3'),
                'address_father'=> 'القاهرة',
                'name_mother_ar'=> $x['m_ar'],
                'name_mother_en'=> $x['m_en'],
                'national_id_mother'=> '5896321478',
                'passport_id_mother'=> '5896321478',
                'phone_mother'=> '01058963218',
                'job_mother_ar'=> $x['j_ar'],
                'job_mother_en'=> $x['j_en'],
                'nationality_mother_id'=> rand('1','30'),
                'blood_Type_mother_id'=> rand('1','8'),
                'religion_mother_id'=> rand('1','3'),
                'address_mother'=> 'القاهرة',
            ]);
        }

    }
}
