<?php

use App\models\Classroom;
use App\models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();

        $xs = [
            [
                'ar' => 'أ',
                'en' => 'a',
            ],
            [
                'ar' => 'ب',
                'en' => 'b',
            ],
            [
                'ar' => 'ج',
                'en' => 'c',
            ],
            [
                'ar' => 'د',
                'en' => 'd',
            ],
            [
                'ar' => 'و',
                'en' => 'e',
            ],
            [
                'ar' => 'ي',
                'en' => 'f',
            ],

        ];
        $i = 0;
        foreach($xs as $x)
        {
            $i++;
            Section::create([

                'name_ar'=> $x['ar'],
                'name_en'=> $x['en'],
                'status'=> 1,
                'grade_id'=> 1,
                'classroom_id'=> rand(1,3),
            ]);
        }
    }
}
