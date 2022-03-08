<?php

use App\models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
    

            Admin::create([
                'name_ar' => 'محمود',
                'name_en' => 'mahmoud',
                'email' => 'mahmoud.kora40@gmail.com',
                'password' => '00000000',
                'gender' => '1'
            ]);

        
    }
}
