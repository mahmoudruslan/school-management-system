<?php


use App\models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StudentSeeder extends Seeder
{


    public function run()
    {
        DB::table('students')->delete();
        factory(Student::class, 300)->create();
    }
}
