<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('admins', function (Blueprint $table) {
            $table->id('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('email');
            $table->string('password');
            $table->string('gender');
            $table->foreignId('role_id')->nullable()->references('id')->on('roles');
            $table->string('phone');
            $table->unsignedBigInteger('specialization_id')->nullable();
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
            $table->string('joining_date');
            $table->string('address');
            $table->string('religion');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('admins');
    }
}
