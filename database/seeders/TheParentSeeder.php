<?php
namespace Database\Seeders;
use App\Models\TheParent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TheParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('the_parents')->delete();
        TheParent::factory()->count(10)->create();
    }
}
