<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('projects',function(Blueprint $table){
            $table->increments('project_id');
            
            $table->string('projectName')->unique();
            
            $table->string('description');
            $table->integer('categoryID');

           
            $table->string('siteArea');
            $table->string('GFA');
            $table->integer('clientName')->nullable();
            $table->string('architectName')->nullable();
            
            $table->string('structureName')->nullable();
            
            $table->string('mepName')->nullable();
            
            $table->string('qsName')->nullable();
            

            $table->string('contractorName')->nullable();
            
            $table->string('fileList')->nullable();
            $table->string('createdBy')->nullable();
            $table->timestamps();

            $table->foreign('categoryID')->references('id')->on('categories')->onUpdate('cascade');

            $table->foreign('architectName')->references('name')->on('users')->onUpdate('cascade');
            $table->foreign('clientName')->references('name')->on('users')->onUpdate('cascade');
            $table->foreign('structureName')->references('name')->on('users')->onUpdate('cascade');
            $table->foreign('mepName')->references('name')->on('users')->onUpdate('cascade');
            $table->foreign('qsName')->references('name')->on('users')->onUpdate('cascade');
            $table->foreign('contractorName')->references('name')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
