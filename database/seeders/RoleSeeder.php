<?php
namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->delete();
        Role::create([
            'name_ar' => 'مدير',
            'name_en' => 'supervisor',
            'permissions' => [
                "grades",
                "classrooms",
                "sections",
                "parents",
                "teachers",
                "students",
                "promotions",
                "graduated",
                "accounting",
                "attendances",
                "subjects",
                "results",
                "books",
                "school_data",
                "roles"
                ]
            ]);
    }
}
