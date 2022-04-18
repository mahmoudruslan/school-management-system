<?php
namespace Database\Seeders;
use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->delete();
            Grade::create([
                'name_ar' => 'المرحلة الثانوية',
                'name_en' => 'High school',
                'notes' => 'من السيدر',
            ]);
    }
}
