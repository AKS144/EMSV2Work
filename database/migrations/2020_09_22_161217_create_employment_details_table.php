<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->UnsignedBigInteger('employee_id');
            $table->string('roll_no')->nullable();
            $table->string('employee_type')->nullable();
            $table->string('office_email')->nullable();
            $table->string('emergency_number')->nullable();
            $table->string('passport')->nullable();

            // $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::dropIfExists('employment_details');
    }
}
