<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->unsignedBigInteger('specialization_id')->nullable();
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
            $table->string('joining_date');
            $table->string('address');
            $table->string('religion');
            $table->string('note')->nullable();
            $table->foreignId('admin_id')->references('id')->on('admins')->onDelete('cascade');

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
        Schema::dropIfExists('teachers');
    }
}
