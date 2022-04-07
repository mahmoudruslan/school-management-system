<?php

use App\models\TheParent;
use Illuminate\Database\Seeder;

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

        factory(TheParent::class, 500)->create();
    }
}
