<?php

use App\models\User;
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
        DB::table('users')->delete();
    

            User::create([
                'name' => 'mahmoud',
                'email' => 'mahmoud.kora40@gmail.com',
                'password' => '00000000'
            ]);

        
    }
}
