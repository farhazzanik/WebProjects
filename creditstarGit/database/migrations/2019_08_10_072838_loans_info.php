<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoansInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('loans_info', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->bigInteger('fk_user_id')->unsigned();
            $table->foreign('fk_user_id')->references('id')->on('user_info');
            $table->double('amount',8,2);
            $table->double('interest',8,2);
            $table->bigInteger('duration');
            $table->string('start_date');
            $table->string('end_date');
            $table->bigInteger('campaign');
            $table->bigInteger('status');
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
         Schema::dropIfExists('loans_info');
    }
}
