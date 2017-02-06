<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nav_id')->unsigned();
            $table->string('jobname');
            $table->string('jobcount');
            $table->string('jobplace');
            $table->longText('keywords');
            $table->longText('description');
            $table->longText('details');
            $table->integer('weihao');
            $table->integer('showsnot');
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
        Schema::drop('jobs');
    }
}
