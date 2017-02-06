<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nav_id')->unsigned();
            $table->string('title');
            $table->string('zz');
            $table->longText('keywords');
            $table->longText('description');
            $table->string('filepath');
            $table->longText('details');
            $table->string('tags');
            $table->integer('weihao');
            $table->integer('showsnot');
            $table->integer('comment')->default('1');
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
        Schema::drop('articles');
    }
}
