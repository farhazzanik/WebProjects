<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('employee_info', function (Blueprint $table) {
            $table->bigInteger('emp_id')->primary();
            $table->bigInteger('fk_com_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('emp_email');
            $table->string('emp_phone');
            $table->string('emp_address');
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
        //
         Schema::dropIfExists('employee_info');
    }
}
