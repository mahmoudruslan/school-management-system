<?php

use App\models\BloodType;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blood_types')->delete();

        $bloodTypes = ['​O+', 'A+', 'O-', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
        foreach($bloodTypes as $bloodType){
            BloodType::create([
                'name' => $bloodType
            ]);
        }
    }
}
