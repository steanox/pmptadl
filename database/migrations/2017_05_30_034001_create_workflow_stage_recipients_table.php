<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowStageRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectWorkflowStages_users',function(Blueprint $table){
            $table->increments('id');
            $table->integer('workflowStageID')->unsigned();
            $table->integer('userID')->unsigned();

            $table->foreign('workflowStageID')->references('workflowStageID')->on('projectWorkflowStages')->onUpdate('cascade');
            $table->foreign('userID')->references('id')->on('users')->onUpdate('cascade');
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('projectWorkflowStages_users');
    }
}
