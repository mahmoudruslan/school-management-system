<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BloodTypeSeeder::class,
            NationalitySeeder::class,
            ReligionSeeder::class,
            AdminSeeder::class,
            SpecializationSeeder::class,
            GradeSeeder::class,
            ClassroomSeeder::class,
            TeacherSeeder::class,
            SectionSeeder::class,
            ParentSeeder::class,
            StudentSeeder::class,


        ]);
    }
}
