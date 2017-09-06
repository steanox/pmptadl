<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectWorkflow',function(Blueprint $table){
            $table->increments('workflowID');
            $table->integer('project_id')->unsigned();
            $table->string('workflowName')->unique();
            $table->string('approvalBy');
            $table->string('status');
            $table->timestamps();
            
            $table->foreign('project_id')->references('project_id')->on('projects')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('projectWorkflow');
    }
}
