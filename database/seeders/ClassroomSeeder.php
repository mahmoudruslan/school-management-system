<?php
namespace Database\Seeders;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->delete();
        $grades = Grade::pluck('id');
        $classroom_numbers = [
                [
                    'ar' => 'الأول',
                    'en' => 'first',
                ],
                [
                    'ar' => 'الثاني',
                    'en' => 'second',
                ],
                [
                    'ar' => 'الثالث',
                    'en' => 'third',
                ],
        ];
        foreach($grades as $grade)
        {
            foreach($classroom_numbers as $classroom_number)
            {
                Classroom::create([
                    'name_ar' => 'الصف '.$classroom_number['ar'],
                    'name_en' => $classroom_number['en'].' classroom',
                    'grade_id' => $grade,
                ]);
            }
        }
        
    }
}
