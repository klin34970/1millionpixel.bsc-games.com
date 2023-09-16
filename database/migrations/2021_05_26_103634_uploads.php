<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Uploads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function(Blueprint $table){
            $table->increments('id');
            $table->string('original_name', 64);
            $table->morphs('uploadable');
            $table->string('name', 64);
            $table->string('type', 32);
            $table->integer('size')->unsigned();
            $table->string('file', 128);
            $table->tinyInteger('position')->unsigned();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploads');
    }
}
