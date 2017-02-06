<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections_article', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id');
            $table->string('title');
            $table->integer('order');
            $table->string('orderkey');
            $table->string('ordervalue');
            $table->integer('count');
            $table->integer('navid');

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
        Schema::drop('sections_article');
    }
}
