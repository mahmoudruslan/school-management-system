<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {





        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('email');
            $table->string('password');

            $table->foreignId('student_nationality_id')->references('id')->on('nationalities');
            $table->unsignedBigInteger('student_blood_type_id')->nullable();
            $table->foreign('student_blood_type_id')->references('id')->on('blood_types');
            $table->string('date_of_birth');
            $table->string('religion');


            $table->unsignedInteger('grade_id')->nullable();
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->unsignedBigInteger('classroom_id')->nullable();
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('the_parents')->onDelete('cascade');
            $table->string('joining_date')->default(date('Y-m-d'));
            $table->string('gender');
            $table->string('student_address');
            $table->string('entry_status')->default('0');
            $table->softDeletes();
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
        Schema::dropIfExists('students');
    }
}
