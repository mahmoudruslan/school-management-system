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
            $table->string('email')->unique();
            $table->string('password');

            //Father information
            $table->string('name_father_ar');
            $table->string('name_father_en');
            $table->string('national_id_father');
            $table->string('passport_id_father');
            $table->string('phone_father');
            $table->string('job_father_ar');
            $table->string('job_father_en');

            $table->bigInteger('nationality_father_id')->unsigned();
            $table->foreign('nationality_father_id')->references('id')->on('nationalities')->onDelete('cascade');

            $table->bigInteger('blood_Type_father_id')->unsigned();
            $table->foreign('blood_Type_father_id')->references('id')->on('blood_types')->onDelete('cascade');

            $table->bigInteger('religion_father_id')->unsigned();
            $table->foreign('religion_father_id')->references('id')->on('religions')->onDelete('cascade');

            $table->string('address_father');

            //Mother information
            $table->string('name_mother_ar');
            $table->string('name_mother_en');
            $table->string('national_id_mother');
            $table->string('passport_id_mother');
            $table->string('phone_mother');
            $table->string('job_mother_ar');
            $table->string('job_mother_en');

            $table->bigInteger('nationality_mother_id')->unsigned();
            $table->foreign('nationality_mother_id')->references('id')->on('nationalities')->onDelete('cascade');

            $table->bigInteger('blood_Type_mother_id')->unsigned();
            $table->foreign('blood_Type_mother_id')->references('id')->on('blood_types')->onDelete('cascade');

            $table->bigInteger('religion_mother_id')->unsigned();
            $table->foreign('religion_mother_id')->references('id')->on('religions')->onDelete('cascade');

            $table->string('address_mother');
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
