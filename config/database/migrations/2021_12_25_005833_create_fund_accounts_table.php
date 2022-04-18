<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date')->default(now());
            $table->foreignId('receipt_id')->nullable()->references('id')->on('student_receipts')->onDelete('cascade');
            $table->foreignId('payment_id')->nullable()->references('id')->on('payments')->onDelete('cascade');
            $table->decimal('debit')->default('0.00');
            $table->decimal('credit')->default('0.00');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('fund_accounts');
    }
}
