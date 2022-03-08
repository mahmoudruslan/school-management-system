<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {












        Schema::create('the_parents', function (Blueprint $table) {
            $table->id();

            $table->string('father_name_ar');
            $table->string('father_name_en');
            $table->string('mother_name_ar');
            $table->string('mother_name_en');
            
            $table->string('father_national_id');
            $table->string('father_phone');
            $table->string('father_job_ar')->nullable();
            $table->string('father_job_en')->nullable();
            $table->foreignId('father_nationality_id')->references('id')->on('nationalities')->onDelete('cascade');


            $table->string('mother_national_id');
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
        Schema::dropIfExists('the_parents');
    }
}
