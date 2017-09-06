<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectWorkflowStages',function(Blueprint $table){
            $table->increments('workflowStageID');
            $table->integer('workflowID')->unsigned();
            $table->integer('stageOrder');
            $table->string('creator');
            $table->string('fileStatus');
            $table->string('fileAttached');
            $table->string('comment');
            $table->timestamps();
            
            $table->foreign('workflowID')->references('workflowID')->on('projectWorkflow')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projectWorkflowStages');
    }
}
