<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('minutes',function(Blueprint $table){
            $table->increments('id');
             $table->string('name');
            $table->string('document')->nullable();
            $table->string('documentPath')->nullable();
            $table->string('notedby');
            // $table->string('distribution');

            $table->integer('projectID')->unsigned();
            $table->foreign('projectID')->references('project_id')->on('projects')->onUpdate('cascade');
            
            $table->integer('remarkID')->unsigned();
            $table->foreign('remarkID')->references('id')->on('users')->onUpdate('cascade');

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
        Schema::dropIfExists('minutes');
    }
}
