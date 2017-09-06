<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectFileTrfHstTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectFileTransferHistory',function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('status')->nullable();
            $table->string('fileName');
            $table->string('fileCode');
            $table->date('validUntil');
            $table->integer('projectID')->unsigned();
            $table->string('sentTo');
            
            $table->foreign('projectID')->references('project_id')->on('projects')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projectFileTransferHistory');
    }
}
