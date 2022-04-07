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
            
            SchoolDataSeeder::class,
            BloodTypeSeeder::class,
            NationalitySeeder::class,
            RoleSeeder::class,
            SpecializationSeeder::class,
            GradeSeeder::class,
            ClassroomSeeder::class,
            
            SubjectSeeder::class,
            TheParentSeeder::class,
            
            AdminSeeder::class,
            SectionSeeder::class,
            StudentSeeder::class,
            
        ]);
    }
}
