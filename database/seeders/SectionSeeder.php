<?php
namespace Database\Seeders;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        foreach($xs as $x)
        {
            $section = Section::create([

                'name_ar'=> $x['ar'],
                'name_en'=> $x['en'],
                'status'=> 1,
                'grade_id'=> 1,
                'classroom_id'=> rand(1,3)
            ]);
            $x = Section::find($section->id);
            $x->admins()->attach(1);
        }
    }
}
