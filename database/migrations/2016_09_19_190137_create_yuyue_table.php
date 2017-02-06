<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYuyueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yuyue', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service');
            $table->string('name');
            $table->string('phone');
            $table->string('xiaoqu');
            $table->string('mianji');
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
        Schema::drop('yuyue');
    }
}
