<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('user_info', function (Blueprint $table) {
                  $table->bigInteger('id')->primary()->unsigned();
                    $table->string('first_name');
                    $table->string('last_name');
                    $table->string('email');
                    $table->bigInteger('personal_code');
                    $table->string('phone');
                    $table->bigInteger('active');
                    $table->bigInteger('dead');
                    $table->string('lang');
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
          Schema::dropIfExists('user_info');
    }
}
