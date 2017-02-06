<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nav_id')->unsigned();
            $table->string('name');
            $table->string('title')->nullable();
            $table->longText('parameter')->nullable();
            $table->longText('filepath');
            $table->longText('details');
            $table->integer('weihao');
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
        Schema::drop('products');
    }
}
