<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->string('name')->default("游客")->nullable();
            $table->string('icon')->default("/public/imgs/default-user-icon.jpg")->nullable();
            $table->longText('content');
            $table->integer('praise')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('os')->nullable();
            $table->integer('showsnot');
            $table->string('whose')->nullable();
            $table->dateTime('published_at');
            $table->timestamps();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
