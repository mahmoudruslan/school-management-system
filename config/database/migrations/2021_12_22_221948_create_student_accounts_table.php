<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAccountsTable extends Migration
{

    public function up()
    {
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->references('id')->on('students');
            $table->foreignId('fee_invoice_id')->nullable()->references('id')->on('fee_invoices')->onDelete('cascade');
            $table->foreignId('receipt_id')->nullable()->references('id')->on('student_receipts')->onDelete('cascade');
            $table->foreignId('fee_processing_id')->nullable()->references('id')->on('fee_processings')->onDelete('cascade');
            $table->foreignId('payment_id')->nullable()->references('id')->on('payments')->onDelete('cascade');
            $table->string('type');
            $table->decimal('debit')->default('0.00');
            $table->decimal('credit')->default('0.00');
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
        Schema::dropIfExists('student_accounts');
    }
}
