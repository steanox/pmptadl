<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fileLists',function(Blueprint $table){
            $table->increments('id');
            
            // $table->string('status')->nullable();
            $table->string('fileName');

            $table->string('fileCode');
            // $table->date('validUntil');
            
            $table->string('fileType');
            $table->string('filePath');

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
        Schema::dropIfExists('fileLists');
    }
}
