<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitenavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitenavs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned();
            $table->string('parentid')->nullable();
            $table->string('nickname');
            $table->string('name');
            $table->string('hierarchy');
            $table->integer('layout');
            $table->integer('weihao');
            $table->integer('sectionid')
            $table->longText('keywords')->nullable();
            $table->longText('description')->nullable();
            $table->string('banner');
            $table->boolean('showsnot');
            $table->string('showdetails')->nullable()->default('0');
            $table->string('detailsposition')->nullable()->default('1');
            $table->longText('details')->nullable();
            $table->integer('footershow');
            $table->dateTime('published_at');
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('navtypes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sitenavs');
    }
}
