<?php
namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StudentSeeder extends Seeder
{
    public function run()
    {
        // DB::table('students')->delete();
        Student::factory()->count(200)->create();
    }
}
