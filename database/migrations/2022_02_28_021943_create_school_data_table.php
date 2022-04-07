<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_data', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->string('school_time')->nullable();
            $table->string('school_rating')->nullable();
            $table->string('year_founded')->nullable();
            $table->string('grade');
            $table->string('phone');
            $table->string('email');
            $table->string('school_manager')->nullable();
            $table->string('city')->nullable();
            $table->string('address');
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_data');
    }
}
