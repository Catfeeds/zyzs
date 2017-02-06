<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlinechatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onlinechats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('to');
            $table->string('from');
            $table->string('nickname')->nullable();
            $table->longText('content')->nullable();
            $table->string('msgType');
            $table->string('img')->nullable();
            $table->integer('send');
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
        Schema::drop('onlinechats');
    }
}
