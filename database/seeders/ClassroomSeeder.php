<?php
namespace Database\Seeders;
use App\Models\Classroom;
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

        $xs = [
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
        foreach($xs as $x)
        {
            Classroom::create([
                'name_ar' => 'الصف '.$x['ar'],
                'name_en' => $x['en'].' classroom',
                'grade_id' => 1,
            ]);
        }
    }
}
