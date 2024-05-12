<?php
namespace Database\Seeders;

use App\Models\Classroom;
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
        $classrooms = Classroom::select('id', 'grade_id')->get();

        $sections_names = [
            [
                'ar' => 'أ',
                'en' => 'a',
            ],
            [
                'ar' => 'ب',
                'en' => 'b',
            ],
        ];

            foreach ($classrooms as $classroom) {
                foreach($sections_names as $sections_name){
                    $section = Section::create([
                        'name_ar'=> $sections_name['ar'],
                        'name_en'=> $sections_name['en'],
                        'status'=> 1,
                        'grade_id'=> $classroom->grade_id,
                        'classroom_id'=> $classroom->id
                    ]);
                    $sections = Section::find($section->id);
                    $sections->admins()->attach(1);
                }
            }
        

    }
}
