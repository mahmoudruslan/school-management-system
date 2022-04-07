<?php

use Illuminate\Database\Seeder;
use \App\models\Specialization;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        $specializations = [


            [
                'en' => 'Arabic',
                'ar' =>  'عربي'
            ],
            [
                'en' => 'mathematics',
                'ar' =>  'رياضيات'
            ],
            [
                'en' => 'religion',
                'ar' =>  'دين'
            ],
            [
                'en' => 'Einglish',
                'ar' =>  'إنجليزي'
            ],
            [
                'en' => 'games',
                'ar' =>  'ألعاب'
            ],
            [
                'en' => 'Sciences',
                'ar' =>  'علوم'
            ],
            [
                'en' => 'studies',
                'ar' =>  'دراسات'
            ],
            [
                'en' => 'computer',
                'ar' =>  'حاسب الي'
            ],
            [
                'en' => 'fee',
                'ar' =>  'رسم'
            ],
            [
                'en' => 'Economie',
                'ar' =>  'اقتصاد'
            ],
            [
                'en' => 'German',
                'ar' =>  'ألماني'
            ],
            [
                'en' => 'French',
                'ar' =>  'فرنسي'
            ],
            [
                'en' => 'date',
                'ar' =>  'تاريخ'
            ],
            [
                'en' => 'geography',
                'ar' =>  'جغرافية'
            ],
            [
                'en' => 'philosophy',
                'ar' =>  'فلسفة'
            ],
            [
                'en' => 'Logic',
                'ar' =>  'منطق'
            ],
            [
                'en' => 'psychology',
                'ar' =>  'علم النفس'
            ],
            [
                'en' => 'Sociology',
                'ar' =>  'علم الاجتماع'
            ],
            [
                'en' => 'chemistry',
                'ar' =>  'كيمياء'
            ],
            [
                'en' => 'Physics',
                'ar' =>  'الفيزياء'
            ],
            [
                'en' => 'alive',
                'ar' =>  'أحياء'
            ],
            [
                'en' => 'radio journalism',
                'ar' =>  'صحافة إذاعة'
            ],

        ];
        foreach ($specializations as $specialization){
            Specialization::create([

                'name_ar' => $specialization['ar'],
                'name_en' =>  $specialization['en'],


            ]);
        }
    }
}
