<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinuteUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('minuteUsers',function(Blueprint $table){
            $table->increments('id');

            $table->integer('userID')->unsigned();
            $table->foreign('userID')->references('id')->on('users')->onUpdate('cascade');
            
            $table->integer('minuteID')->unsigned();
            $table->foreign('minuteID')->references('id')->on('minutes')->onUpdate('cascade');

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
        Schema::dropIfExists('minuteUsers');
    }
}
