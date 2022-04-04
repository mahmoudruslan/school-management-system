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
            RoleSeeder::class,
            SpecializationSeeder::class,
            AdminSeeder::class,
            GradeSeeder::class,
            ClassroomSeeder::class,
            SectionSeeder::class,
            
        ]);
    }
}
