<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplineDocumentFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplineDocumentFile', function (Blueprint $table) {
            $table->increments('id');
            $table->string("fileName");
            $table->string("fileURL");
            $table->string("comment");
            $table->string("reviewBy");
            $table->string("uploadBy");
            $table->integer('disciplineDocumentId')->unsigned();
            $table->timestamps();

            $table->foreign('disciplineDocumentId')->references('id')->on('disciplineDocument')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disciplineDocumentFile');
    }
}
