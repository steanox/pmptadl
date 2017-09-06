<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Disciplines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplines', function (Blueprint $table){
            $table->increments('id');
            $table->string('disciplineName');
            $table->string('projectID');
            $table->string('userList')->nullable();
            $table->string('initiatorName')->nullable;
            $table->timestamps();
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
            Schema::dropIfExists('disciplines');
    }
}
