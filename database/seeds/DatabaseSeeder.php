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
            GenderSeeder::class,
            SpecializationSeeder::class,

        ]);
    }
}
