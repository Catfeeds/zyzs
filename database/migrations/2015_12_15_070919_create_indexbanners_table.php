<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexbannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indexbanners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filepath');
            $table->integer('weihao');
            $table->integer('showsnot');
            $table->string('mfilepath');
            $table->longText('alink');
            $table->dateTime('published_at');
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
        Schema::drop('indexbanners');
    }
}
