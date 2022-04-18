<?php
namespace Database\Seeders;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->delete();

        $first_classroom_subjects = [
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
                'en' => 'drawing',
                'ar' =>  'رسم'
            ],
            [
                'en' => 'philosophy',
                'ar' =>  'فلسفة'
            ],
            [
                'en' => 'Logic',
                'ar' =>  'منطق'
            ],

        ];

        $second_classroom_subjects = $first_classroom_subjects + [
            
                [
                    'en' => 'chemistry',
                    'ar' =>  'كيمياء'
                ],
                [
                    'en' => 'Physics',
                    'ar' =>  'الفيزياء'
                ],

        ];
        foreach ($first_classroom_subjects as $x) {
            Subject::create([
                'name_ar' => $x['ar'],
                'name_en' => $x['en'],
                'grade_id' => 1,
                'classroom_id' => 1,
                'degree' => 100,
            ]);
        }

        foreach ($second_classroom_subjects as $x) {
            Subject::create([
                'name_ar' => $x['ar'],
                'name_en' => $x['en'],
                'grade_id' => 1,
                'classroom_id' => 2,
                'degree' => 100,
            ]);
        }
    }
}
