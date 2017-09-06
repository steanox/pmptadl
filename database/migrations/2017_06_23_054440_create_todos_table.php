<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('todos',function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->date('date');
            $table->date('dueDate');
            $table->string('status')->nullable();

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
        Schema::dropIfExists('todos');
    }
}
