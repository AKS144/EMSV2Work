<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOvertimepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overtimepayments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->UnsignedBigInteger('employee_id');
            // $table->float('amount');
            // $table->string('month')->nullable();
            $table->float('overtime_amount')->nullable();
            $table->date('overtime_date')->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('overtimepayments');
    }
}
