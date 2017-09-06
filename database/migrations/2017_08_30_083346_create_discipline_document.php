<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplineDocument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplineDocument', function (Blueprint $table) {
            $table->increments('id');
            $table->string("status");
            $table->integer("disciplineID")->unsigned();
            $table->string("firstUploadBy");
            $table->string("lastUploadBy");
            $table->string("approvalBy")->nullable();
            $table->timestamps();

            $table->foreign('disciplineID')->references('id')->on('disciplines')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disciplineDocument');
    }
}
