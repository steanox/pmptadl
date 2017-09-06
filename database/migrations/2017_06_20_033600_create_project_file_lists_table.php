<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectFileListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectFileLists',function(Blueprint $table){
            $table->increments('id');
            
            $table->integer('projectID')->unsigned();
            $table->foreign('projectID')->references('project_id')->on('projects')->onUpdate('cascade');
            $table->integer('filelistID')->unsigned();
            $table->foreign('filelistID')->references('id')->on('fileLists')->onUpdate('cascade');

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
        Schema::dropIfExists('projectFileLists');
    }
}
