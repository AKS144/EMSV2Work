<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->UnsignedBigInteger('employee_id');
            $table->UnsignedBigInteger('salary_id');
            $table->UnsignedBigInteger('salary_type_id');
            $table->UnsignedBigInteger('user_id');
            $table->float('paid_amount');
            $table->date('transaction_date');
            $table->string('remark');
            $table->text('description');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
}
