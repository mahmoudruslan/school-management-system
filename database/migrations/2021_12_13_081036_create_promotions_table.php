<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->unsignedInteger('from_grade_id');
            $table->foreign('from_grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->unsignedBigInteger('from_classroom_id');
            $table->foreign('from_classroom_id')->references('id')->on('classrooms')->onDelete('cascade');



            $table->unsignedInteger('to_grade_id');
            $table->foreign('to_grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->unsignedBigInteger('to_classroom_id');
            $table->foreign('to_classroom_id')->references('id')->on('classrooms')->onDelete('cascade');


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
        Schema::dropIfExists('promotions');
    }
}
