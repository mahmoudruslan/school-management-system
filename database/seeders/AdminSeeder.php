<?php
namespace Database\Seeders;
use App\Models\Admin;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


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
        DB::table('teachers')->delete();
    

            $admin = Admin::create([
                'name_ar' => 'محمود',
                'name_en' => 'mahmoud',
                'email' => 'mahmoud.40@gmail.com',
                'password' => '00000000',
                'gender' => '1',
                'role_id' => '1'
            ]);

            Teacher::create([
                'admin_id' => $admin->id,
                'phone' => '01092199386',
                'specialization_id' => '12',
                'joining_date' => '2020-5-5',
                'address' => 'دمياط',
                'religion' => '1',
                'note' => 'from seeder',
            ]);

        
    }
}
