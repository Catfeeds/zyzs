<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nav_id')->unsigned();
            $table->string('name');
            $table->string('cover');
            $table->integer('weihao');
            $table->longText('options')->nullable();
            $table->integer('showsnot');
            $table->longText('keywords');
            $table->longText('description');
            $table->dateTime('published_at');
            $table->timestamps();
            $table->foreign('nav_id')->references('id')->on('sitenavs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('albums');
    }
}
